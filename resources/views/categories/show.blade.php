<x-app-layout>
    @php
        // Load counts and calculations
        $category->loadCount('assets');
        $availableAssets = $category->assets->where('status', 'Available')->count();
        $assignedAssets = $category->assets->where('status', 'Assigned')->count();
        $damagedAssets = $category->assets->where('status', 'Damaged')->count();
        $totalAssets = $category->assets->count();
        
        $availablePercentage = $totalAssets > 0 ? round(($availableAssets/$totalAssets)*100, 1) : 0;
        $assignedPercentage = $totalAssets > 0 ? round(($assignedAssets/$totalAssets)*100, 1) : 0;
        $damagedPercentage = $totalAssets > 0 ? round(($damagedAssets/$totalAssets)*100, 1) : 0;

        $healthScore = $totalAssets > 0 ? (($availableAssets + $assignedAssets * 0.8) / $totalAssets) * 100 : 0;
        $healthScore = min(100, max(0, $healthScore));
    @endphp

    <div class="flex min-h-screen bg-slate-50 dark:bg-gray-900" x-data="{ sidebarOpen: true }">
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed inset-y-0 left-0 z-50 transition-all duration-300 bg-slate-800 dark:bg-gray-800 text-slate-300 shadow-xl overflow-hidden hidden lg:flex flex-col">
            <div class="flex items-center justify-center h-16 bg-slate-900 border-b border-slate-700">
                <i class="fas fa-microchip text-indigo-400 text-2xl"></i>
                <span x-show="sidebarOpen" class="ml-3 font-bold text-white tracking-wider uppercase text-sm">Categories</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 hover:bg-slate-700 hover:text-white rounded-xl transition-all group">
                    <i class="fas fa-th-large w-6 group-hover:text-indigo-400"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium">Dashboard</span>
                </a>

                <a href="{{ route('assets.index') }}" class="flex items-center p-3 hover:bg-slate-700 hover:text-white rounded-xl transition-all group">
                    <i class="fas fa-boxes w-6 group-hover:text-indigo-400"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium">Assets</span>
                </a>

                <a href="{{ route('categories.index') }}" class="flex items-center p-3 text-white bg-indigo-600 rounded-xl transition-all">
                    <i class="fas fa-tags w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium">Categories</span>
                </a>

                <a href="{{ route('employees.index') }}" class="flex items-center p-3 hover:bg-slate-700 hover:text-white rounded-xl transition-all group">
                    <i class="fas fa-users w-6 group-hover:text-indigo-400"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium">Employees</span>
                </a>
  <a href="{{ route('assignments.index') }}" class="flex items-center p-3 hover:bg-slate-700 hover:text-white rounded-xl transition-all group">
                            <i class="fas fa-users w-6 group-hover:text-indigo-400"></i>
                            <span class="font-medium">Assignments</span>
                        </a>
                <div class="pt-4 mt-4 border-t border-slate-700">
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 hover:bg-slate-700 hover:text-white rounded-xl transition-all group">
                        <i class="fas fa-cog w-6 group-hover:text-indigo-400"></i>
                        <span x-show="sidebarOpen" class="ml-3 font-medium">Profile</span>
                    </a>
                </div>
            </nav>

            <div class="p-4 bg-slate-900">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full p-3 text-rose-400 hover:bg-rose-500 hover:text-white rounded-xl transition-all">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span x-show="sidebarOpen" class="ml-3 font-medium text-sm text-left">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

<main 
  :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" 
  class="flex-1 transition-all duration-300 pt-16"
>
           

<div class="bg-gradient-to-r from-slate-800 to-indigo-900 px-8 py-8">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div class="w-16 h-16 rounded-2xl bg-white bg-opacity-10 backdrop-blur-md flex items-center justify-center border border-white border-opacity-20 shadow-xl mr-5">
                            <i class="{{ $category->icon ?: 'fas fa-tag' }} text-white text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="font-black text-3xl text-white tracking-tight">{{ $category->name }}</h2>
                            <p class="text-indigo-200 opacity-80 uppercase text-xs font-bold tracking-widest mt-1">Asset Category Management</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                         <a href="{{ route('categories.index') }}"
       class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold
              bg-white bg-opacity-10 text-white border border-white border-opacity-20
              hover:bg-white hover:text-indigo-700 transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to Assets
    </a>
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white bg-opacity-10 text-white border border-white border-opacity-20">
                            <span class="w-2 h-2 rounded-full mr-2 {{ $category->is_active ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

<div class="p-6 lg:p-8 max-w-7xl mx-auto mt-6">
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <div class="lg:w-1/3 space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-slate-200 p-6 overflow-hidden relative">
                            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Specifications</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase">Description</label>
                                    <p class="text-slate-700 dark:text-slate-300 mt-1 leading-relaxed">{{ $category->description ?: 'No detailed description provided for this category.' }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[10px] font-bold text-slate-400 uppercase">Slug</label>
                                        <p class="font-mono text-xs text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md mt-1 italic">{{ $category->slug }}</p>
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-slate-400 uppercase">Brand Color</label>
                                        <div class="flex items-center mt-1">
                                            <div class="w-4 h-4 rounded-full mr-2" style="background-color: {{ $category->color }};"></div>
                                            <span class="text-xs font-bold">{{ strtoupper($category->color) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 pt-6 border-t border-slate-100 grid grid-cols-2 gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-600 rounded-xl text-xs font-bold transition-all">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <a href="{{ route('assets.create', ['category_id' => $category->id]) }}" class="flex items-center justify-center px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold shadow-lg shadow-indigo-200 transition-all hover:bg-indigo-700">
                                    <i class="fas fa-plus mr-2"></i> Add Asset
                                </a>
                            </div>
                        </div>

                    
                    </div>

                    <div class="lg:w-2/3">
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                                <h3 class="font-bold text-slate-800">Inventory Registry</h3>
                                <span class="text-xs font-black px-3 py-1 bg-slate-200 text-slate-600 rounded-full">{{ $totalAssets }} Units</span>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                                        <tr>
                                            <th class="px-6 py-4">Asset Detail</th>
                                            <th class="px-6 py-4">Status</th>
                                            <th class="px-6 py-4">Ownership</th>
                                            <th class="px-6 py-4 text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($category->assets as $asset)
                                        <tr class="hover:bg-slate-50 transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-slate-700">{{ $asset->name }}</div>
                                                <div class="text-[10px] text-slate-400 font-mono tracking-tighter">{{ $asset->serial_number }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full {{ $asset->status == 'Available' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                                    {{ $asset->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($asset->status == 'Assigned')
                                                    <div class="text-xs font-bold text-slate-700">{{ $asset->assignments->first()->user->name ?? 'User' }}</div>
                                                    <div class="text-[10px] text-slate-400">Since {{ $asset->assignments->first()->assigned_date->format('M d') }}</div>
                                                @else
                                                    <span class="text-xs text-slate-300 italic">Unassigned</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <a href="{{ route('assets.show', $asset) }}" class="p-2 text-slate-400 hover:text-indigo-600"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('assets.edit', $asset) }}" class="p-2 text-slate-400 hover:text-emerald-600"><i class="fas fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</x-app-layout>