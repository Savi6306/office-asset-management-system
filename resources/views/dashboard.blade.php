<x-app-layout>
    @php
        // Set default values if variables are not defined
        $totalAssets = $totalAssets ?? 0;
        $assignedAssets = $assignedAssets ?? 0;
        $availableAssets = $availableAssets ?? 0;
        $damagedAssets = $damagedAssets ?? 0;
        $totalEmployees = $totalEmployees ?? 0;
        $totalCategories = $totalCategories ?? 0;
        $recentAssets = $recentAssets ?? collect([]);
        $recentAssignments = $recentAssignments ?? [];
        $recentEmployees = $recentEmployees ?? collect([]);
        $categories = $categories ?? collect([]);
        $assetsByStatus = $assetsByStatus ?? [];
        
        // Calculate percentages
        $assignedPercentage = $totalAssets > 0 ? round(($assignedAssets/$totalAssets)*100, 1) : 0;
        $availablePercentage = $totalAssets > 0 ? round(($availableAssets/$totalAssets)*100, 1) : 0;
        $damagedPercentage = $totalAssets > 0 ? round(($damagedAssets/$totalAssets)*100, 1) : 0;
        
        // Colors for status
        $statusColors = [
            'Assigned' => 'text-green-600 bg-green-100 dark:bg-green-900 dark:text-green-300',
            'Available' => 'text-blue-600 bg-blue-100 dark:bg-blue-900 dark:text-blue-300',
            'Damaged' => 'text-red-600 bg-red-100 dark:bg-red-900 dark:text-red-300',
            'Under Repair' => 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900 dark:text-yellow-300',
        ];
    @endphp
    
    <x-slot name="header">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 -mx-8 -mt-2 px-8 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight">
                        <i class="fas fa-tachometer-alt mr-3"></i>{{ __('Admin Dashboard') }}
                    </h2>
                    <p class="text-indigo-200 mt-1 text-sm">
                        Office Asset Management System • Welcome, {{ auth()->user()->name }}
                    </p>
                </div>
                <div class="flex items-center space-x-4 mt-2 md:mt-0">
                    <div class="hidden md:flex items-center space-x-3">
                        <span class="text-xs px-3 py-1 rounded-full bg-white bg-opacity-20 text-white">
                            <i class="fas fa-calendar-alt mr-1"></i>{{ now()->format('M d, Y') }}
                        </span>
                        <span class="text-xs px-3 py-1 rounded-full bg-green-500 bg-opacity-30 text-green-100">
                            <i class="fas fa-circle mr-1" style="font-size: 6px;"></i> Active
                        </span>
                        <span class="text-xs px-3 py-1 rounded-full bg-blue-500 bg-opacity-30 text-blue-100">
                            <i class="fas fa-users mr-1"></i> {{ $totalEmployees }} Employees
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col lg:flex-row py-6">
        <!-- Sidebar - Left Side -->
        <div class="w-full lg:w-64 mb-6 lg:mb-0 lg:mr-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- User Profile -->
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                            <i class="fas fa-user text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">{{ auth()->user()->name }}</h4>
                            <p class="text-indigo-200 text-xs">Admin</p>
                        </div>
                    </div>
                </div>

                <!-- Main Navigation -->
                <div class="p-4">
                    
                    <div class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg bg-indigo-50 dark:bg-indigo-900 dark:bg-opacity-30 text-indigo-600 dark:text-indigo-300">
                            <i class="fas fa-tachometer-alt mr-3 text-sm"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        
                        <a href="{{ route('assets.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-boxes mr-3 text-sm"></i>
                            <span class="font-medium">Assets</span>
                        </a>
                        
                        <a href="{{ route('employees.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-users mr-3 text-sm"></i>
                            <span class="font-medium">Employees</span>
                        </a>
                        
                        <a href="{{ route('assignments.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-handshake mr-3 text-sm"></i>
                            <span class="font-medium">Assignments</span>
                        </a>
                        
                        <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-tags mr-3 text-sm"></i>
                            <span class="font-medium">Categories</span>
                        </a>
                    
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <h5 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">SYMMARY</h5>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-blue-100 dark:bg-blue-800 flex items-center justify-center mr-2">
                                    <i class="fas fa-box text-blue-600 dark:text-blue-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Total Assets</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $totalAssets }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-green-100 dark:bg-green-800 flex items-center justify-center mr-2">
                                    <i class="fas fa-user-check text-green-600 dark:text-green-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Assigned</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $assignedAssets }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-indigo-100 dark:bg-indigo-800 flex items-center justify-center mr-2">
                                    <i class="fas fa-check-circle text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Available</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $availableAssets }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-cyan-100 dark:bg-cyan-800 flex items-center justify-center mr-2">
                                    <i class="fas fa-users text-cyan-600 dark:text-cyan-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Employees</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $totalEmployees }}</span>
                        </div>
                    </div>
                </div>

                <!-- System Actions -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <h5 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">SYSTEM</h5>
                    
                    <div class="space-y-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-user-cog mr-3 text-sm"></i>
                            <span class="font-medium">Profile</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900 dark:bg-opacity-20 text-red-600 dark:text-red-300">
                                <i class="fas fa-sign-out-alt mr-3 text-sm"></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 max-w-7xl mx-auto sm:px-6 lg:px-0">
            
            <!-- Stats Cards - Now 5 Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-6">
                <!-- Total Assets -->
                <div class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg border border-blue-100 dark:border-blue-900 p-4 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold text-blue-600 dark:text-blue-300 uppercase tracking-wider">TOTAL ASSETS</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalAssets }}</p>
                            <div class="mt-2">
                                <div class="w-full bg-blue-100 dark:bg-blue-900 rounded-full h-1.5">
                                    <div class="bg-blue-500 dark:bg-blue-400 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-500 p-2 rounded-lg">
                            <i class="fas fa-boxes text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Assigned Assets -->
                <div class="bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg border border-green-100 dark:border-green-900 p-4 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold text-green-600 dark:text-green-300 uppercase tracking-wider">ASSIGNED</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $assignedAssets }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-green-100 dark:bg-green-900 rounded-full h-1.5">
                                    <div class="bg-green-500 dark:bg-green-400 h-1.5 rounded-full" style="width: {{ $assignedPercentage }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-500 p-2 rounded-lg">
                            <i class="fas fa-user-check text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Available Assets -->
                <div class="bg-gradient-to-br from-white to-indigo-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg border border-indigo-100 dark:border-indigo-900 p-4 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold text-indigo-600 dark:text-indigo-300 uppercase tracking-wider">AVAILABLE</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $availableAssets }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-indigo-100 dark:bg-indigo-900 rounded-full h-1.5">
                                    <div class="bg-indigo-500 dark:bg-indigo-400 h-1.5 rounded-full" style="width: {{ $availablePercentage }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-indigo-500 p-2 rounded-lg">
                            <i class="fas fa-check-circle text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Employees -->
                <div class="bg-gradient-to-br from-white to-cyan-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg border border-cyan-100 dark:border-cyan-900 p-4 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold text-cyan-600 dark:text-cyan-300 uppercase tracking-wider">TOTAL EMPLOYEES</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalEmployees }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-cyan-100 dark:bg-cyan-900 rounded-full h-1.5">
                                    <div class="bg-cyan-500 dark:bg-cyan-400 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-cyan-500 p-2 rounded-lg">
                            <i class="fas fa-users text-white text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg border border-purple-100 dark:border-purple-900 p-4 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold text-purple-600 dark:text-purple-300 uppercase tracking-wider">CATEGORIES</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalCategories }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-purple-100 dark:bg-purple-900 rounded-full h-1.5">
                                    <div class="bg-purple-500 dark:bg-purple-400 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-purple-500 p-2 rounded-lg">
                            <i class="fas fa-tags text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions - Now with 4 Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-white dark:from-purple-900 dark:bg-opacity-30 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-bolt text-purple-500 mr-2"></i> Quick Actions
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Perform common tasks quickly</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Add Asset -->
                        <a href="{{ route('assets.create') }}" class="group bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900 dark:bg-opacity-30 dark:to-blue-900 dark:bg-opacity-10 border-2 border-blue-200 dark:border-blue-800 rounded-xl p-5 text-center transition-all duration-300 hover:border-blue-400 hover:shadow-lg hover-lift">
                            <div class="w-12 h-12 rounded-lg bg-blue-500 group-hover:bg-blue-600 flex items-center justify-center mx-auto mb-3 transition-colors">
                                <i class="fas fa-plus text-white text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Add Asset</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Register new asset</p>
                        </a>

                        <!-- Assign Asset -->
                        <a href="{{ route('assignments.create') }}" class="group bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:bg-opacity-30 dark:to-green-900 dark:bg-opacity-10 border-2 border-green-200 dark:border-green-800 rounded-xl p-5 text-center transition-all duration-300 hover:border-green-400 hover:shadow-lg hover-lift">
                            <div class="w-12 h-12 rounded-lg bg-green-500 group-hover:bg-green-600 flex items-center justify-center mx-auto mb-3 transition-colors">
                                <i class="fas fa-handshake text-white text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Assign Asset</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Assign to employee</p>
                        </a>

                        <!-- Add Employee -->
                        <a href="{{ route('employees.create') }}" class="group bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900 dark:bg-opacity-30 dark:to-purple-900 dark:bg-opacity-10 border-2 border-purple-200 dark:border-purple-800 rounded-xl p-5 text-center transition-all duration-300 hover:border-purple-400 hover:shadow-lg hover-lift">
                            <div class="w-12 h-12 rounded-lg bg-purple-500 group-hover:bg-purple-600 flex items-center justify-center mx-auto mb-3 transition-colors">
                                <i class="fas fa-user-plus text-white text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Add Employee</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Register new employee</p>
                        </a>

                        <!-- Categories -->
                        <a href="{{ route('categories.index') }}" class="group bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900 dark:bg-opacity-30 dark:to-amber-900 dark:bg-opacity-10 border-2 border-amber-200 dark:border-amber-800 rounded-xl p-5 text-center transition-all duration-300 hover:border-amber-400 hover:shadow-lg hover-lift">
                            <div class="w-12 h-12 rounded-lg bg-amber-500 group-hover:bg-amber-600 flex items-center justify-center mx-auto mb-3 transition-colors">
                                <i class="fas fa-tags text-white text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Categories</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Manage categories</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Three Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <!-- Recent Assets -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-white dark:from-blue-900 dark:bg-opacity-30 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-2"></i> Recent Assets
                            </h3>
                            <a href="{{ route('assets.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 flex items-center">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="space-y-4 p-6">
                            @forelse($recentAssets as $asset)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                                        <i class="fas fa-laptop text-blue-600 dark:text-blue-300"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $asset->name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">SN:</span> {{ $asset->serial_number }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    @if($asset->status == 'Assigned')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <i class="fas fa-user-check mr-1"></i> Assigned
                                    </span>
                                    @elseif($asset->status == 'Available')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        <i class="fas fa-check mr-1"></i> Available
                                    </span>
                                    @elseif($asset->status == 'Damaged' || $asset->condition == 'Damaged')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                        <i class="fas fa-times mr-1"></i> Damaged
                                    </span>
                                    @else
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                        {{ $asset->status }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-box-open text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">No assets found</p>
                                <a href="{{ route('assets.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                                    <i class="fas fa-plus mr-2"></i> Add Your First Asset
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Assignments -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-white dark:from-green-900 dark:bg-opacity-30 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                                    <i class="fas fa-user-tag text-green-500 mr-2"></i> Recent Assignments
                                </h3>
                            </div>
                            <div class="flex items-center space-x-2">
                            
                                <a href="{{ route('assignments.index') }}" class="text-xs text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 flex items-center">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentAssignments as $assignment)
                            <div class="flex items-start p-4 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900 dark:to-emerald-900 flex items-center justify-center">
                                        <i class="fas fa-handshake text-green-600 dark:text-green-300"></i>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $assignment->asset_name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                <i class="fas fa-user mr-1"></i> Assigned to: {{ $assignment->user_name }}
                                            </p>
                                        </div>
                                        <button onclick="window.location.href='{{ route('assignments.edit', $assignment->id) }}'" class="text-xs px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-800 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 rounded">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span>
                                            <i class="far fa-clock mr-1"></i>
                                            @php
                                                $date = \Carbon\Carbon::parse($assignment->assigned_at ?? now());
                                                echo $date->format('M d, Y');
                                            @endphp
                                        </span>
                                        @if($assignment->status == 'active')
                                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Active
                                        </span>
                                        @else
                                        <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                            Inactive
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-handshake text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">No assignments yet</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Assign assets to employees</p>
                                <a href="{{ route('assignments.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                                    <i class="fas fa-plus mr-2"></i> Create Assignment
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Employees -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-white dark:from-purple-900 dark:bg-opacity-30 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-user-plus text-purple-500 mr-2"></i> Recent Employees
                            </h3>
                            <a href="{{ route('employees.index') }}" class="text-xs text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 flex items-center">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentEmployees as $employee)
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900 dark:to-pink-900 flex items-center justify-center">
                                        <i class="fas fa-user text-purple-600 dark:text-purple-300"></i>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $employee->name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $employee->position }} • {{ $employee->department }}
                                    </p>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            ID: {{ $employee->employee_id }}
                                        </span>
                                        @if($employee->status == 'active')
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Active
                                        </span>
                                        @elseif($employee->status == 'on_leave')
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            On Leave
                                        </span>
                                        @else
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Inactive
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-users text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">No employees found</p>
                                <a href="{{ route('employees.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm">
                                    <i class="fas fa-plus mr-2"></i> Add First Employee
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section - Single Chart -->
<div class="mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                <i class="fas fa-chart-pie text-blue-500 mr-2"></i> Assets by Status
            </h3>
            <span class="text-sm text-gray-600 dark:text-gray-400">
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($assetsByStatus as $status => $count)
                @php
                    $colorClass = $statusColors[$status] ?? 'text-gray-600 bg-gray-100 dark:bg-gray-900 dark:text-gray-300';
                    $colorClasses = explode(' ', $colorClass);
                    $textColor = $colorClasses[0];
                    // Percentage calculation (sirf progress bar ki width ke liye background mein rakha hai)
                    $widthPercentage = $totalAssets > 0 ? ($count / $totalAssets) * 100 : 0;
                @endphp

                <a href="{{ route('assets.index', ['status' => $status]) }}" 
                   class="group block bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 p-5 rounded-xl border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-md hover:border-blue-400 dark:hover:border-blue-500 transform hover:-translate-y-1">
                    
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            <span class="inline-block w-3 h-3 rounded-full mr-2 {{ $textColor }} bg-current"></span>
                            {{ $status }}
                        </span>
                        <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                    </div>

                    <div class="flex items-baseline space-x-2 mb-3">
                        <div class="text-4xl font-extrabold {{ $textColor }}">{{ $count }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-medium font-sans italic">Items</div>
                    </div>

                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 ease-out {{ $textColor }} bg-current" 
                             style="width: {{ $widthPercentage }}%; opacity: 0.7;"></div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
    </div>

    <!-- Add Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <!-- Add some custom animation -->
    <style>
        .hover-lift {
            transition: transform 0.2s ease-in-out;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Dark mode scrollbar */
        .dark ::-webkit-scrollbar-track {
            background: #374151;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #6B7280;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #9CA3AF;
        }
        
        /* Animation for stats cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stats-card {
            animation: fadeInUp 0.5s ease-out;
            animation-fill-mode: both;
        }
        
        .stats-card:nth-child(1) { animation-delay: 0.1s; }
        .stats-card:nth-child(2) { animation-delay: 0.2s; }
        .stats-card:nth-child(3) { animation-delay: 0.3s; }
        .stats-card:nth-child(4) { animation-delay: 0.4s; }
        .stats-card:nth-child(5) { animation-delay: 0.5s; }
        
        /* Sidebar styling */
        .sidebar-link {
            transition: all 0.2s ease;
        }
        
        .sidebar-link:hover {
            transform: translateX(3px);
            background-color: rgba(59, 130, 246, 0.1);
        }
    </style>
    
    <script>
        // Update dashboard data periodically
        function updateDashboardStats() {
            console.log('Dashboard stats updated at ' + new Date().toLocaleTimeString());
        }
        
        // Update every 5 minutes
        setInterval(updateDashboardStats, 300000);
    </script>
</x-app-layout>