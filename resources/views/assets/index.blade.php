<x-app-layout>
    @php
        // Set default values for all stats variables
        $totalAssets = $totalAssets ?? 0;
        $availableAssets = $availableAssets ?? 0;
        $assignedAssets = $assignedAssets ?? 0;
        $damagedAssets = $damagedAssets ?? 0;
        
        // Ensure assets variable exists
        $assets = $assets ?? collect([]);
    @endphp
    
    <x-slot name="header">
        <div class="bg-gradient-to-r from-teal-600 to-emerald-700 -mx-8 -mt-2 px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center mr-3">
                        <i class="fas fa-boxes text-white"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight">
                            {{ __('Asset Management') }}
                        </h2>
                        <p class="text-teal-200 text-sm">Track and manage all office assets</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('assets.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-white text-teal-700 font-medium rounded-lg hover:bg-teal-50 transition-colors">
                        <i class="fas fa-plus mr-2"></i> Add New Asset
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col lg:flex-row py-6">
        <!-- Sidebar - Left Side -->
        <div class="w-full lg:w-64 mb-6 lg:mb-0 lg:mr-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- User Profile -->
                <div class="px-6 py-4 bg-gradient-to-r from-teal-600 to-emerald-600">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                            <i class="fas fa-user text-teal-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">{{ auth()->user()->name }}</h4>
                            <p class="text-teal-200 text-xs">Asset Manager</p>
                        </div>
                    </div>
                </div>

                <!-- Main Navigation -->
                <div class="p-4">
                    
                    <div class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-tachometer-alt mr-3 text-sm"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        
                        <a href="{{ route('assets.index') }}" class="flex items-center px-3 py-2 rounded-lg bg-teal-50 dark:bg-teal-900 dark:bg-opacity-30 text-teal-600 dark:text-teal-300">
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
                    <h5 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">ASSET SUMMARY</h5>
                    
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
                                    <i class="fas fa-check-circle text-green-600 dark:text-green-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Available</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $availableAssets }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-orange-100 dark:bg-orange-800 flex items-center justify-center mr-2">
                                    <i class="fas fa-user-check text-orange-600 dark:text-orange-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Assigned</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $assignedAssets }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-red-100 dark:bg-red-800 flex items-center justify-center mr-2">
                                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-300 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Damaged</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $damagedAssets }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Filter -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <h5 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">QUICK FILTER</h5>
                    
                    <div class="space-y-2">
                        <a href="{{ route('assets.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-filter mr-3 text-sm"></i>
                            <span class="font-medium">All Assets</span>
                        </a>
                        
                        <a href="{{ route('assets.index', ['status' => 'Available']) }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-check-circle mr-3 text-sm text-green-500"></i>
                            <span class="font-medium">Available</span>
                        </a>
                        
                        <a href="{{ route('assets.index', ['status' => 'Assigned']) }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-user-check mr-3 text-sm text-orange-500"></i>
                            <span class="font-medium">Assigned</span>
                        </a>
                        
                        <a href="{{ route('assets.index', ['status' => 'Damaged']) }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-exclamation-triangle mr-3 text-sm text-red-500"></i>
                            <span class="font-medium">Damaged</span>
                        </a>
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
            
            <!-- Quick Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Assets -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 border-l-4 border-teal-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Assets</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAssets }}</p>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-teal-500 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-teal-100 dark:bg-teal-900 dark:bg-opacity-30">
                            <i class="fas fa-boxes text-teal-600 dark:text-teal-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Available Assets -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Available Assets</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $availableAssets }}</p>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalAssets > 0 ? ($availableAssets/$totalAssets)*100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 dark:bg-opacity-30">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Assigned Assets -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Assigned Assets</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $assignedAssets }}</p>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $totalAssets > 0 ? ($assignedAssets/$totalAssets)*100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900 dark:bg-opacity-30">
                            <i class="fas fa-user-check text-orange-600 dark:text-orange-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Damaged Assets -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Damaged Assets</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $damagedAssets }}</p>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalAssets > 0 ? ($damagedAssets/$totalAssets)*100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 dark:bg-opacity-30">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assets Table Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-teal-50 to-white dark:from-teal-900 dark:bg-opacity-20 dark:to-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-boxes text-teal-500 mr-2"></i> All Assets
                            </h3>
                            @if(method_exists($assets, 'total') && $assets->total() > 0)
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Showing {{ $assets->firstItem() }} to {{ $assets->lastItem() }} of {{ $assets->total() }} assets
                            </p>
                            @else
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $assets->count() }} assets found
                            </p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Search assets..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-900 dark:text-gray-300 w-64"
                                       id="assetSearch">
                                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                            </div>
                            <div class="relative">
                                <select id="statusFilter" class="pl-10 pr-8 py-2 border border-gray-300 dark:border-gray-700 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-900 dark:text-gray-300 appearance-none">
                                    <option value="">All Status</option>
                                    <option value="Available">Available</option>
                                    <option value="Assigned">Assigned</option>
                                    <option value="Damaged">Damaged</option>
                                </select>
                                <i class="fas fa-filter absolute left-3 top-2.5 text-gray-400"></i>
                                <i class="fas fa-chevron-down absolute right-3 top-2.5 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Asset Details
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Assigned To
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="assetTableBody">
                            @forelse($assets as $asset)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors asset-row" 
                                    data-name="{{ strtolower($asset->name) }}"
                                    data-serial="{{ strtolower($asset->serial_number) }}"
                                    data-status="{{ strtolower($asset->status) }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center mr-3 bg-opacity-10" 
                                                 style="background-color: {{ $asset->category->color ?? '#3b82f6' }};">
                                                @if($asset->category && $asset->category->icon)
                                                    <i class="{{ $asset->category->icon }} text-lg" style="color: {{ $asset->category->color ?? '#3b82f6' }};"></i>
                                                @else
                                                    <i class="fas fa-box text-lg" style="color: {{ $asset->category->color ?? '#3b82f6' }};"></i>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <h4 class="font-bold text-gray-900 dark:text-white text-sm">{{ $asset->name }}</h4>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                            Serial: <span class="font-mono">{{ $asset->serial_number }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                    <i class="fas fa-calendar-alt mr-1"></i>
                                                    Added {{ $asset->created_at->diffForHumans() }}
                                                </div>
                                                @if($asset->condition && $asset->condition != 'Good')
                                                    <div class="mt-1">
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                                            <i class="fas fa-tools mr-1"></i>
                                                            {{ $asset->condition }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($asset->category)
                                                <div class="flex-shrink-0 w-8 h-8 rounded-lg mr-2 flex items-center justify-center" 
                                                     style="background-color: {{ $asset->category->color }}20;">
                                                    <i class="{{ $asset->category->icon ?? 'fas fa-tag' }} text-xs" style="color: {{ $asset->category->color }};"></i>
                                                </div>
                                                <div>
                                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $asset->category->name }}</span>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $asset->category->assets_count ?? 0 }} assets</p>
                                                </div>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500">No Category</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($asset->status == 'Available')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:bg-opacity-30 dark:text-green-300">
                                                <span class="w-2 h-2 rounded-full mr-2 bg-green-500"></span>
                                                Available
                                            </span>
                                        @elseif($asset->status == 'Assigned')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:bg-opacity-30 dark:text-orange-300">
                                                <span class="w-2 h-2 rounded-full mr-2 bg-orange-500"></span>
                                                Assigned
                                            </span>
                                        @elseif($asset->status == 'Damaged')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:bg-opacity-30 dark:text-red-300">
                                                <span class="w-2 h-2 rounded-full mr-2 bg-red-500"></span>
                                                Damaged
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:bg-opacity-30 dark:text-gray-300">
                                                <span class="w-2 h-2 rounded-full mr-2 bg-gray-500"></span>
                                                {{ $asset->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($asset->status == 'Assigned' && $asset->assignments && $asset->assignments->count() > 0)
                                            @php
                                                $assignment = $asset->assignments->first();
                                                $employee = $assignment->employee ?? $assignment->user;
                                            @endphp
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                                    <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $employee->name ?? 'Unknown' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        @if($assignment->assigned_date)
                                                            Assigned {{ \Carbon\Carbon::parse($assignment->assigned_date)->format('M d, Y') }}
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                        <i class="fas fa-id-card mr-1"></i>
                                                        {{ $employee->employee_id ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-2">
                                                    <i class="fas fa-user-slash text-gray-400"></i>
                                                </div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Not Assigned</p>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col space-y-2">
                                            <!-- Quick Actions -->
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('assets.show', $asset) }}" 
                                                   class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors"
                                                   title="View Details">
                                                    <i class="fas fa-eye mr-1"></i> View
                                                </a>
                                                <a href="{{ route('assets.edit', $asset) }}" 
                                                   class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-colors"
                                                   title="Edit Asset">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                            </div>
                                            
                                            <!-- Status Actions -->
                                            <div class="mt-2 grid grid-cols-2 gap-2">
                                                @if($asset->status != 'Assigned')
                                                    <a href="{{ route('assignments.create', ['asset_id' => $asset->id]) }}" 
                                                       class="inline-flex items-center justify-center px-3 py-1.5 bg-orange-600 hover:bg-orange-700 text-white text-xs font-medium rounded-lg transition-colors">
                                                        <i class="fas fa-user-tag mr-1"></i> Assign
                                                    </a>
                                                @else
                                                    <a href="{{ route('assignments.edit', $asset->assignments->first()->id ?? '') }}" 
                                                       class="inline-flex items-center justify-center px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium rounded-lg transition-colors">
                                                        <i class="fas fa-exchange-alt mr-1"></i> Transfer
                                                    </a>
                                                @endif
                                                
                                                @if($asset->status != 'Damaged')
                                                    <form action="{{ route('assets.show', $asset) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Damaged">
                                                        <button type="submit" 
                                                                onclick="return confirm('Mark this asset as damaged?')"
                                                                class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors">
                                                            <i class="fas fa-times mr-1"></i> Damage
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            
                                            <!-- Delete Option -->
                                            <form action="{{ route('assets.destroy', $asset) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this asset? This action cannot be undone.')"
                                                  class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-400 dark:text-gray-500">
                                            <i class="fas fa-boxes text-5xl mb-4"></i>
                                            <p class="text-xl font-medium mb-2">No assets found</p>
                                            <p class="mb-6">Start by adding your first asset to the inventory.</p>
                                            <a href="{{ route('assets.create') }}" 
                                               class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors">
                                                <i class="fas fa-plus mr-2"></i> Add First Asset
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if(method_exists($assets, 'hasPages') && $assets->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-400">
                                Showing {{ $assets->firstItem() }} to {{ $assets->lastItem() }} of {{ $assets->total() }} results
                            </div>
                            <div>
                                {{ $assets->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column - Recent Activities & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Assignments -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-history text-purple-500 mr-2"></i> Recent Assignments
                    </h3>
                    <div class="space-y-4">
                        @php
                            // This is just for display, in real app you should pass this from controller
                            $recentAssignments = \App\Models\Assignment::with(['asset', 'employee'])
                                ->latest()
                                ->take(3)
                                ->get() ?? collect([]);
                        @endphp
                        
                        @forelse($recentAssignments as $assignment)
                            <div class="flex items-start p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900 dark:to-pink-900 flex items-center justify-center mr-3">
                                    <i class="fas fa-handshake text-purple-600 dark:text-purple-300"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 dark:text-white text-sm">
                                        {{ $assignment->asset->name ?? 'Unknown Asset' }}
                                    </p>
                                    <div class="flex items-center justify-between mt-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-user mr-1"></i> {{ $assignment->employee->name ?? 'Unknown' }}
                                        </p>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $assignment->assigned_date ? \Carbon\Carbon::parse($assignment->assigned_date)->format('M d') : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-handshake text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400">No recent assignments</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('assignments.index') }}" 
                           class="text-sm text-teal-600 dark:text-teal-400 hover:text-teal-800 dark:hover:text-teal-300">
                            View All Assignments →
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-bolt text-orange-500 mr-2"></i> Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('assets.create') }}" 
                           class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900 dark:bg-opacity-20 dark:to-blue-800 dark:bg-opacity-10 border border-blue-200 dark:border-blue-700 rounded-lg hover:border-blue-400 dark:hover:border-blue-500 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center mr-3">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Add New Asset</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Register a new asset</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('assignments.create') }}" 
                           class="flex items-center p-3 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:bg-opacity-20 dark:to-green-800 dark:bg-opacity-10 border border-green-200 dark:border-green-700 rounded-lg hover:border-green-400 dark:hover:border-green-500 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center mr-3">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Assign Asset</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Assign asset to employee</p>
                            </div>
                        </a>
                        
                        <a href="#" 
                           class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900 dark:bg-opacity-20 dark:to-purple-800 dark:bg-opacity-10 border border-purple-200 dark:border-purple-700 rounded-lg hover:border-purple-400 dark:hover:border-purple-500 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3">
                                <i class="fas fa-file-import text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Import Assets</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Bulk import from CSV</p>
                            </div>
                        </a>
                        
                        <a href="#" 
                           class="flex items-center p-3 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900 dark:bg-opacity-20 dark:to-amber-800 dark:bg-opacity-10 border border-amber-200 dark:border-amber-700 rounded-lg hover:border-amber-400 dark:hover:border-amber-500 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center mr-3">
                                <i class="fas fa-file-export text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Export Assets</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Export to Excel/CSV</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('assetSearch');
            const assetRows = document.querySelectorAll('.asset-row');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                assetRows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    const serial = row.getAttribute('data-serial');
                    
                    if (name.includes(searchTerm) || serial.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Filter by status
            const statusFilter = document.getElementById('statusFilter');
            statusFilter.addEventListener('change', function() {
                const selectedStatus = this.value.toLowerCase();
                
                assetRows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    
                    if (!selectedStatus || status === selectedStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Quick status change
        function updateAssetStatus(assetId, newStatus) {
            if (confirm(`Are you sure you want to mark this asset as ${newStatus}?`)) {
                fetch(`/assets/${assetId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Failed to update asset status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating asset status');
                });
            }
        }
    </script>

    <!-- Additional CSS -->
    <style>
        .hover-lift {
            transition: transform 0.2s ease-in-out;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
        }
        
        /* Scrollbar styling */
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
        
        .dark .overflow-x-auto::-webkit-scrollbar-track {
            background: #374151;
        }
        .dark .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #6B7280;
        }
        .dark .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #9CA3AF;
        }
        
        /* Sidebar styling */
        .sidebar-link {
            transition: all 0.2s ease;
        }
       
        .sidebar-link:hover {
            transform: translateX(3px);
            background-color: rgba(45, 212, 191, 0.1);
        }
    </style>
</x-app-layout>