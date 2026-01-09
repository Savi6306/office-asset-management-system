<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
   // CategoryController.php mein index method

public function index()
{
    // 10 categories per page ke hisaab se paginate karein
    $categories = Category::withCount('assets')->orderBy('name')->paginate(10);
    
    return view('categories.index', compact('categories'));
}
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string|size:7',
            'is_active' => 'boolean'
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function show(Category $category)
{
    // Check if assets relationship exists and load it
    $category->load(['assets' => function($query) {
        $query->with('assignments.user')->latest();
    }]);
    
    // Also load the count
    $category->loadCount('assets');
    
    return view('categories.show', compact('category'));
}

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string|size:7',
            'is_active' => 'boolean'
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        // Check if category has assets
        if ($category->assets()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete category with associated assets!');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    public function getCategoryStats()
    {
        $stats = Category::select('categories.id', 'categories.name', 'categories.color')
            ->selectRaw('COUNT(assets.id) as total_assets')
            ->selectRaw('SUM(CASE WHEN assets.status = "Available" THEN 1 ELSE 0 END) as available')
            ->selectRaw('SUM(CASE WHEN assets.status = "Assigned" THEN 1 ELSE 0 END) as assigned')
            ->selectRaw('SUM(CASE WHEN assets.status = "Damaged" THEN 1 ELSE 0 END) as damaged')
            ->leftJoin('assets', 'categories.id', '=', 'assets.category_id')
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderBy('total_assets', 'desc')
            ->get();

        return response()->json($stats);
    }
}