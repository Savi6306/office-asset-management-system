<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    /**
     * Display a listing of the assets.
     */
    
    // AssetController.php
public function index()
{
    // Get paginated assets with relationships
    $assets = Asset::with(['category', 'assignments.employee'])
                ->latest()
                ->paginate(10);
    
    // Calculate statistics
    $totalAssets = Asset::count();
    $availableAssets = Asset::where('status', 'Available')->count();
    $assignedAssets = Asset::where('status', 'Assigned')->count();
    $damagedAssets = Asset::where('status', 'Damaged')->count();
    
    return view('assets.index', compact(
        'assets',
        'totalAssets',
        'availableAssets',
        'assignedAssets',
        'damagedAssets'
    ));

    $categories = Category::orderBy('name')->paginate(10);
        
        // Get assets with filters
        $assets = Asset::with('category')
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%'.request('search').'%')
                      ->orWhere('serial_number', 'like', '%'.request('search').'%');
            })
            ->when(request('status'), function($query) {
                $query->where('status', request('status'));
            })
            ->when(request('category'), function($query) {
                $query->where('category_id', request('category'));
            })
            ->latest()
            ->paginate(10);

        // Counts for stats
        $assignedCount = Asset::where('status', 'Assigned')->count();
        $damagedCount = Asset::where('status', 'Damaged')->count();

        return view('assets.index', compact('assets', 'categories', 'assignedCount', 'damagedCount'));
    }

    /**
     * Show the form for creating a new asset.
     */
 public function create()
{
    $categories = Category::where('is_active', 1)
                    ->orderBy('name')
                    ->get();

    return view('assets.create', compact('categories'));
}


    /**
     * Store a newly created asset in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'serial_number' => 'required|unique:assets,serial_number',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Available,Assigned,Damaged',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Asset::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('assets.index')
            ->with('success', 'Asset created successfully.');
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit(Asset $asset)
    {
        $categories = Category::all();
        return view('assets.edit', compact('asset', 'categories'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'serial_number' => 'required|unique:assets,serial_number,' . $asset->id,
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Available,Assigned,Damaged',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $asset->update([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('assets.index')
            ->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified asset from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')
            ->with('success', 'Asset deleted successfully.');
    }

    /**
     * Assign asset to user
     */
    public function assign(Request $request, Asset $asset)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Update asset status
        $asset->update(['status' => 'Assigned']);

        // Create assignment record
        $asset->users()->attach($request->user_id, [
            'assigned_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Asset assigned successfully.');
    }

    /**
     * Return asset
     */
    public function return(Asset $asset)
    {
        // Update asset status
        $asset->update(['status' => 'Available']);

        // Update return time
        $asset->users()->updateExistingPivot(
            $asset->users()->latest()->first()->id,
            ['returned_at' => now()]
        );

        return redirect()->back()
            ->with('success', 'Asset returned successfully.');
    }
    public function show(Asset $asset)
{
    $asset->load([
        'category',
        'assignments.employee'
    ]);

    return view('assets.show', compact('asset'));
}

}