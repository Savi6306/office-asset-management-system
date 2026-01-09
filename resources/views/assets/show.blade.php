<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-cyan-700 -mx-8 -mt-2 px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                   <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mr-3">
                        @if($asset->category && $asset->category->icon)
                            <i class="{{ $asset->category->icon }} text-white"></i>
                        @else
                            <i class="fas fa-box text-white"></i>
                        @endif
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight">
                            {{ $asset->name }}
                        </h2>
                        <p class="text-blue-200 text-sm">
                            @if($asset->category)
                                {{ $asset->category->name }} • 
                            @endif
                            Asset Details
                        </p>
                    </div>
                </div>
                <div>
                    @php
                        // Make sure status is Active by default or based on your logic
                        $isActive = $asset->is_active ?? true; // Default to true if not set
                        $statusColors = [
                            'Available' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                            'Assigned' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                            'Damaged' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                            'Lost' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                            'Under Maintenance' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'
                        ];
                        $currentStatus = $asset->status ?? 'Available';
                    @endphp
                    
                    <!-- Status Badge -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$currentStatus] ?? 'bg-gray-100 text-gray-800' }}">
                        <span class="w-2 h-2 rounded-full mr-2 
                            {{ $currentStatus == 'Available' ? 'bg-green-500' : 
                               ($currentStatus == 'Assigned' ? 'bg-orange-500' : 
                               ($currentStatus == 'Damaged' || $currentStatus == 'Lost' ? 'bg-red-500' : 'bg-blue-500')) }}">
                        </span>
                        {{ $currentStatus }}
                    </span>
                    
                    <!-- Active/Inactive Badge (only show if you have this field) -->
                    @if(isset($asset->is_active))
                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                        {{ $asset->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                        <span class="w-1.5 h-1.5 rounded-full mr-1 {{ $asset->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        {{ $asset->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Asset Information Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900/20 dark:to-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-info-circle text-gray-500 mr-2"></i> Asset Information
                        </h3>
                        <!-- Small Action Buttons -->
                        <div class="flex space-x-2">
                            <a href="{{ route('assets.edit', $asset) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-edit mr-1.5 text-xs"></i> Edit
                            </a>
                            <form action="{{ route('assets.destroy', $asset) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this asset?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    <i class="fas fa-trash mr-1.5 text-xs"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $asset->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Serial Number</p>
                                <p class="mt-1 text-gray-900 dark:text-white">
                                    <code class="px-2 py-1 bg-gray-100 dark:bg-gray-900 rounded text-sm">
                                        {{ $asset->serial_number }}
                                    </code>
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</p>
                                <p class="mt-1 text-gray-900 dark:text-white">
                                    @if($asset->category)
                                        <span class="inline-flex items-center">
                                            @if($asset->category->icon)
                                                <i class="{{ $asset->category->icon }} mr-2" style="color: {{ $asset->category->color }};"></i>
                                            @endif
                                            {{ $asset->category->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">No category assigned</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Status & Dates -->
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                @php
                                    $statusColors = [
                                        'Available' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                        'Assigned' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                                        'Damaged' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        'Lost' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        'Under Maintenance' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'
                                    ];
                                @endphp
                                <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$asset->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    <span class="w-2 h-2 rounded-full mr-2 
                                        {{ $asset->status == 'Available' ? 'bg-green-500' : 
                                           ($asset->status == 'Assigned' ? 'bg-orange-500' : 
                                           ($asset->status == 'Damaged' ? 'bg-red-500' : 
                                           ($asset->status == 'Lost' ? 'bg-red-500' : 'bg-blue-500'))) }}">
                                    </span>
                                    {{ $asset->status }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $asset->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $asset->updated_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>

                            @if($asset->purchase_date || $asset->purchase_price)
                            <div class="grid grid-cols-2 gap-4">
                                @if($asset->purchase_date)
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Purchase Date</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $asset->purchase_date->format('M d, Y') }}
                                    </p>
                                </div>
                                @endif
                                @if($asset->purchase_price)
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Purchase Price</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        ${{ number_format($asset->purchase_price, 2) }}
                                    </p>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    @if($asset->description)
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Description</p>
                        <p class="text-gray-900 dark:text-white">
                            {{ $asset->description }}
                        </p>
                    </div>
                    @endif

                    <!-- Additional Action Buttons (Optional - removed the big ones) -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex space-x-3 justify-center">
                        <!-- Quick Actions -->
                        <div class="flex space-x-2">
                            <!-- Assign Button -->
                            @if($asset->status == 'Available')
                            <a href="{{ route('assignments.create', ['asset_id' => $asset->id]) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-user-plus mr-1.5 text-xs"></i> Assign
                            </a>
                            @endif
                            
                        
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment History -->
            @if($asset->assignments->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900/20 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-history text-gray-500 mr-2"></i> Assignment History
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Assigned To
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Assigned Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Return Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($asset->assignments as $assignment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-2">
                                            <i class="fas fa-user text-blue-600 dark:text-blue-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $assignment->user->name ?? 'Unknown' }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $assignment->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $assignment->assigned_date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $assignment->return_date ? $assignment->return_date->format('M d, Y') : 'Not returned' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($assignment->return_date)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            Returned
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            Active
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-1">
                                        @if(!$assignment->return_date)
                                        <form action="{{ route('assignments.return', $assignment) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Mark this assignment as returned?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                    class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 p-1">
                                                <i class="fas fa-check-circle text-xs"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <a href="{{ route('assignments.edit', $assignment) }}" 
                                           class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('assignments.destroy', $assignment) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Delete this assignment record?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
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
            @endif

        </div>
    </div>
</x-app-layout>