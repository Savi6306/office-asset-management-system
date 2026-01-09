<x-app-layout>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
            <!-- Sidebar component -->
            <div class="flex flex-col flex-1 min-h-0 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <!-- Sidebar header -->
                <div class="flex items-center h-16 flex-shrink-0 px-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-600 to-cyan-700">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-white bg-opacity-20 flex items-center justify-center mr-3">
                            <i class="fas fa-tag text-white"></i>
                        </div>
                        <span class="text-white font-semibold">Categories</span>
                    </div>
                </div>
                
                <!-- Sidebar content -->
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <!-- Navigation -->
                    <nav class="flex-1 px-4 space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md 
                                  {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i class="fas fa-home mr-3 flex-shrink-0 h-6 w-6 
                               {{ request()->routeIs('dashboard') ? 'text-blue-500 dark:text-blue-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                            Dashboard
                        </a>
                        
                        <!-- Categories -->
                        <a href="{{ route('categories.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md 
                                  {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i class="fas fa-tags mr-3 flex-shrink-0 h-6 w-6 
                               {{ request()->routeIs('categories.*') ? 'text-blue-500 dark:text-blue-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                            Categories
                        </a>
                        
                        <!-- Assets -->
                        <a href="{{ route('assets.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md 
                                  {{ request()->routeIs('assets.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i class="fas fa-boxes mr-3 flex-shrink-0 h-6 w-6 
                               {{ request()->routeIs('assets.*') ? 'text-blue-500 dark:text-blue-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                            Assets
                        </a>
                        
                        <!-- Employees -->
                        <a href="{{ route('employees.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md 
                                  {{ request()->routeIs('employees.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i class="fas fa-users mr-3 flex-shrink-0 h-6 w-6 
                               {{ request()->routeIs('employees.*') ? 'text-blue-500 dark:text-blue-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                            Employees
                        </a>
                        
                        <!-- Assignments -->
                        <a href="{{ route('assignments.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md 
                                  {{ request()->routeIs('assignments.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i class="fas fa-handshake mr-3 flex-shrink-0 h-6 w-6 
                               {{ request()->routeIs('assignments.*') ? 'text-blue-500 dark:text-blue-400' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                            Assignments
                        </a>
                        
                       
                      
                    </nav>
                    
                    <!-- System Actions -->
                    <div class="px-4 mt-6">
                        <div class="p-4 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h4 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                System
                            </h4>
                            <div class="space-y-2">
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                    <i class="fas fa-user-cog mr-2"></i> Profile Settings
                                </a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center text-sm text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:pl-64 flex flex-col flex-1">
            <!-- Mobile sidebar toggle (hidden on desktop) -->
            <div class="lg:hidden flex items-center h-16 px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <button type="button" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <i class="fas fa-bars h-6 w-6"></i>
                </button>
                <span class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">Categories</span>
            </div>

            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow border-b border-gray-200 dark:border-gray-700">
                <div class="px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                <i class="fas fa-tags mr-2 text-blue-600"></i> Categories
                            </h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Manage and organize your asset categories
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('categories.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-plus mr-2"></i> New Category
                            </a>
                        </div>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 dark:bg-opacity-30 mr-4">
                                    <i class="fas fa-tags text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Categories</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $categories->total() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 dark:bg-opacity-30 mr-4">
                                    <i class="fas fa-boxes text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Assets</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ \App\Models\Asset::count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-orange-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900 dark:bg-opacity-30 mr-4">
                                    <i class="fas fa-handshake text-orange-600 dark:text-orange-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Assigned Assets</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ \App\Models\Asset::where('status', 'Assigned')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-purple-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 dark:bg-opacity-30 mr-4">
                                    <i class="fas fa-users text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Active Employees</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ \App\Models\Employee::where('status', 'active')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="py-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                        <div class="mb-6 bg-green-50 dark:bg-green-900 dark:bg-opacity-30 border border-green-200 dark:border-green-700 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800 dark:text-green-300">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="mb-6 bg-red-50 dark:bg-red-900 dark:bg-opacity-30 border border-red-200 dark:border-red-700 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800 dark:text-red-300">
                                        {{ session('error') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Categories Table -->
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900 dark:bg-opacity-20 dark:to-gray-800">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            All Categories
                                        </h3>
                                        @if($categories && $categories->count() > 0)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories
                                        </p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <!-- Search Input -->
                                        <div class="relative">
                                            <input type="text" 
                                                   placeholder="Search categories..." 
                                                   class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 w-64">
                                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-900">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <span>ID</span>
                                                    <i class="fas fa-sort ml-2 text-gray-400"></i>
                                                </div>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <span>Category</span>
                                                    <i class="fas fa-sort ml-2 text-gray-400"></i>
                                                </div>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <span>Assets</span>
                                                    <i class="fas fa-sort ml-2 text-gray-400"></i>
                                                </div>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <span>Status</span>
                                                    <i class="fas fa-sort ml-2 text-gray-400"></i>
                                                </div>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($categories as $category)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900 dark:text-white font-mono">
                                                    #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg flex items-center justify-center mr-3" 
                                                         style="background-color: {{ $category->color }}20;">
                                                        @if($category->icon)
                                                            <i class="{{ $category->icon }}" style="color: {{ $category->color }};"></i>
                                                        @else
                                                            <i class="fas fa-tag" style="color: {{ $category->color }};"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900 dark:text-white">
                                                            {{ $category->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $category->slug }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                        <i class="fas fa-boxes mr-2"></i>
                                                        {{ $category->assets_count }}
                                                    </span>
                                                    @if($category->assets_count > 0)
                                                    <div class="ml-3">
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            @php
                                                                $assignedCount = \App\Models\Asset::where('category_id', $category->id)
                                                                    ->where('status', 'Assigned')
                                                                    ->count();
                                                            @endphp
                                                            {{ $assignedCount }} assigned
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                    {{ $category->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:bg-opacity-30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:bg-opacity-30 dark:text-red-300' }}">
                                                    <span class="w-2 h-2 rounded-full mr-2 {{ $category->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center space-x-3">
                                                    <!-- View Button -->
                                                    <a href="{{ route('categories.show', $category) }}" 
                                                       class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900 dark:hover:bg-blue-800 dark:bg-opacity-30 text-blue-700 dark:text-blue-300 rounded-lg transition-colors"
                                                       title="View Category">
                                                        <i class="fas fa-eye mr-1.5"></i> View
                                                    </a>
                                                    
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('categories.edit', $category) }}" 
                                                       class="inline-flex items-center px-3 py-1.5 bg-green-50 hover:bg-green-100 dark:bg-green-900 dark:hover:bg-green-800 dark:bg-opacity-30 text-green-700 dark:text-green-300 rounded-lg transition-colors"
                                                       title="Edit Category">
                                                        <i class="fas fa-edit mr-1.5"></i> Edit
                                                    </a>
                                                    
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('categories.destroy', $category) }}" 
                                                          method="POST" 
                                                          class="inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 dark:bg-red-900 dark:hover:bg-red-800 dark:bg-opacity-30 text-red-700 dark:text-red-300 rounded-lg transition-colors"
                                                                title="Delete Category">
                                                            <i class="fas fa-trash mr-1.5"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="text-gray-400 dark:text-gray-500">
                                                    <i class="fas fa-tags text-4xl mb-4"></i>
                                                    <p class="text-lg font-medium mb-2">No categories found</p>
                                                    <p class="mb-4">Start by creating your first category</p>
                                                    <a href="{{ route('categories.create') }}" 
                                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                                        <i class="fas fa-plus mr-2"></i> Create Category
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination and Footer -->
                            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($categories && $categories->count() > 0)
                                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <!-- Export Button -->
                                        <a href="#" 
                                           class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                            <i class="fas fa-download mr-2"></i> Export
                                        </a>
                                        
                                        <!-- Pagination Links -->
                                        @if($categories && method_exists($categories, 'links'))
                                        <div class="flex items-center space-x-2">
                                            {{ $categories->links() }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Additional CSS -->
    <style>
        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Dark mode scrollbar */
        .dark .overflow-x-auto::-webkit-scrollbar-track {
            background: #374151;
        }
        .dark .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #6B7280;
        }
        .dark .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #9CA3AF;
        }
        
        /* Hover effects */
        .hover-lift {
            transition: transform 0.2s ease-in-out;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
        }
    </style>
</x-app-layout>