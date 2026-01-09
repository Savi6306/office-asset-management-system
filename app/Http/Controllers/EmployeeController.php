<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Asset;
use App\Models\Assignment;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // List Employees
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    // 🔹 Show Employee Details
    public function show(Employee $employee)
    {
        // Get currently assigned assets (where return_date is null)
        $assignedAssets = Asset::whereHas('assignments', function ($query) use ($employee) {
            $query->where('employee_id', $employee->id)
                  ->whereNull('return_date');
        })->get();

        // Get available assets (not currently assigned to any employee)
        $availableAssets = Asset::whereDoesntHave('assignments', function ($query) {
            $query->whereNull('return_date');
        })->get();

        // Get assignment history
        $assignmentHistory = Assignment::with('asset')
            ->where('employee_id', $employee->id)
            ->orderBy('assigned_date', 'desc')
            ->paginate(10);

        return view('employees.show', compact(
            'employee',
            'assignedAssets',
            'availableAssets',
            'assignmentHistory'
        ));
    }

    // 🔹 Show Create Form
    public function create()
    {
        $departments = [
            'IT',
            'HR',
            'Finance',
            'Admin',
            'Operations',
            'Support'
        ];

        $statuses = [
            'active',
            'inactive',
            'on_leave'
        ];

        return view('employees.create', compact('departments', 'statuses'));
    }

    // Store Employee
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees,employee_id',
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:employees,email',
            'phone'       => 'nullable|string|max:20',
            'department'  => 'required|string',
            'position'    => 'required|string|max:255',
            'hire_date'   => 'required|date',
            'address'     => 'nullable|string',
            'status'      => 'nullable|in:active,inactive,on_leave',
        ]);

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'active';

        Employee::create($data);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully');
    }

    // 🔹 Show Edit Form
    public function edit(Employee $employee)
    {
        $departments = [
            'IT',
            'HR',
            'Finance',
            'Admin',
            'Operations',
            'Support'
        ];

        $statuses = [
            'active',
            'inactive',
            'on_leave'
        ];

        return view('employees.edit', compact('employee', 'departments', 'statuses'));
    }

    // 🔹 Update Employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees,employee_id,' . $employee->id,
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:employees,email,' . $employee->id,
            'phone'       => 'nullable|string|max:20',
            'department'  => 'required|string',
            'position'    => 'required|string|max:255',
            'hire_date'   => 'required|date',
            'address'     => 'nullable|string',
            'status'      => 'nullable|in:active,inactive,on_leave',
        ]);

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'active';

        $employee->update($data);

        return redirect()
            ->route('employees.show', $employee)
            ->with('success', 'Employee updated successfully');
    }

    // 🔹 Delete Employee
    public function destroy(Employee $employee)
    {
        // Check if employee has assigned assets
        $hasAssignedAssets = Assignment::where('employee_id', $employee->id)
            ->whereNull('return_date')
            ->exists();

        if ($hasAssignedAssets) {
            return redirect()
                ->route('employees.index')
                ->with('error', 'Cannot delete employee with assigned assets. Return assets first.');
        }

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully');
    }

    // 🔹 Assign Asset to Employee
    public function assignAsset(Request $request, Employee $employee)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'assigned_date' => 'required|date',
            'condition_assigned' => 'required|in:Excellent,Good,Fair,Poor',
            'notes' => 'nullable|string',
        ]);

        // Check if asset is already assigned
        $alreadyAssigned = Assignment::where('asset_id', $request->asset_id)
            ->whereNull('return_date')
            ->exists();

        if ($alreadyAssigned) {
            return redirect()->back()
                ->with('error', 'This asset is already assigned to another employee.');
        }

        // Create assignment
        Assignment::create([
            'employee_id' => $employee->id,
            'asset_id' => $request->asset_id,
            'assigned_date' => $request->assigned_date,
            'condition_assigned' => $request->condition_assigned,
            'notes' => $request->notes,
        ]);

        return redirect()->back()
            ->with('success', 'Asset assigned successfully.');
    }

    // 🔹 Return Asset from Employee
    public function returnAsset(Request $request, Employee $employee, Asset $asset)
    {
        $request->validate([
            'return_date' => 'required|date',
            'condition_returned' => 'required|in:Excellent,Good,Fair,Poor,Damaged',
            'return_notes' => 'nullable|string',
        ]);

        // Find active assignment
        $assignment = Assignment::where('employee_id', $employee->id)
            ->where('asset_id', $asset->id)
            ->whereNull('return_date')
            ->firstOrFail();

        $assignment->update([
            'return_date' => $request->return_date,
            'condition_returned' => $request->condition_returned,
            'return_notes' => $request->return_notes,
        ]);

        return redirect()->back()
            ->with('success', 'Asset returned successfully.');
    }
}