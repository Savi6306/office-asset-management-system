<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\User;
use App\Models\Assignment;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Asset Statistics
        $totalAssets = Asset::count();
        $assignedAssets = Asset::where('status', 'Assigned')->count();
        $availableAssets = Asset::where('status', 'Available')->count();
        $damagedAssets = Asset::where('status', 'Damaged')->count();

        // User / Employee Statistics
        $totalEmployees = User::count();

        // Category Statistics
        $totalCategories = Category::count();
        $categories = Category::withCount('assets')->get();

        // Recent Assets
        $recentAssets = Asset::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Recent Assignments (from pivot table)
        $recentAssignments = Assignment::with(['asset', 'employee'])
    ->orderBy('assigned_date', 'desc')   // ya created_at
    ->take(2)
    ->get();

    
        // Assets by Status
        $assetsByStatus = [
            'Assigned' => $assignedAssets,
            'Available' => $availableAssets,
            'Damaged' => $damagedAssets,
        ];

        return view('dashboard', compact(
            'totalAssets',
            'assignedAssets',
            'availableAssets',
            'damagedAssets',
            'totalEmployees',
            'totalCategories',
            'recentAssets',
            'recentAssignments',
            'categories',
            'assetsByStatus'
        ));
    }
}
