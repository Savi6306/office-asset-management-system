<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['asset', 'employee'])
            ->latest()
            ->paginate(10);
            
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $assets = Asset::where('status', 'Available')->get();
        $employees = Employee::where('status', 'active')->get();
        
        return view('assignments.create', compact('assets', 'employees'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'asset_id' => 'required|exists:assets,id',
        'employee_id' => 'required|exists:employees,id',
        'assigned_date' => 'required|date',
        'return_date' => 'nullable|date|after:assigned_date',
        'status' => 'required|in:active,returned,damaged', // Add this line
        'notes' => 'nullable|string|max:500',
    ]);

    // Create the assignment
    $assignment = Assignment::create($validated);

    // Update asset status based on assignment status
    $asset = Asset::find($request->asset_id);
    
    if ($request->status == 'active') {
        $asset->update(['status' => 'Assigned']);
    } else {
        $asset->update(['status' => 'Available']);
    }

    return redirect()->route('assignments.index')
        ->with('success', 'Asset assigned successfully!');
}
   public function show(Assignment $assignment)
{
    // Eager load relationships for the show page
    $assignment->load(['asset.category', 'employee']);
    
    return view('assignments.show', compact('assignment'));
}

   public function edit(Assignment $assignment)
{
    return view('assignments.edit', compact('assignment'));
}

public function update(Request $request, Assignment $assignment)
{
    $validated = $request->validate([
        'status' => 'required|in:active,returned,damaged', // 'cancelled' ko yahan allow nahi kiya hai
        'return_date' => 'nullable|date',
        'notes' => 'nullable|string|max:500',
    ]);

    // Update assignment record
    $assignment->update($validated);
    
    $asset = $assignment->asset;
    
    // Status Logic
    if ($request->status == 'active') {
        $asset->update(['status' => 'Assigned']);
    } elseif ($request->status == 'damaged') {
        // Agar status damaged hai, toh asset ko 'Damaged' ya 'Under Maintenance' mark karein
        $asset->update(['status' => 'Damaged']); 
    } elseif ($request->status == 'returned') {
        // Agar return ho gaya hai, toh asset wapas available ho jayega
        $asset->update(['status' => 'Available']);
    }

    return redirect()->route('assignments.index')
        ->with('success', 'Assignment updated and asset status synchronized!');
}
    public function destroy(Assignment $assignment)
    {
        // Mark asset as available when assignment is deleted
        $asset = $assignment->asset;
        $asset->update(['status' => 'Available']);
        
        $assignment->delete();

        return redirect()->route('assignments.index')
            ->with('success', 'Assignment deleted successfully!');
    }
}