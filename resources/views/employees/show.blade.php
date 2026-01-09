<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <i class="fas fa-user mr-2"></i>Employee Details
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ $employee->employee_id }} • {{ $employee->department }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('employees.edit', $employee) }}" 
                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('employees.index') }}" 
                   class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Employee Info Card -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Employee Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start space-x-4 mb-6">
                                <div class="flex-shrink-0">
                                    <div class="h-20 w-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-user text-white text-3xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $employee->name }}
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ $employee->position }}
                                        </span>
                                        @if($employee->status == 'active')
                                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Active
                                        </span>
                                        @elseif($employee->status == 'on_leave')
                                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            On Leave
                                        </span>
                                        @else
                                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Inactive
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Phone</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Hire Date</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->hire_date->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Department</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->department }}</p>
                                </div>
                                @if($employee->address)
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Address</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->address }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Asset Statistics</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-30 rounded-lg">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-800 mr-3">
                                        <i class="fas fa-laptop text-blue-600 dark:text-blue-300"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Currently Assigned</p>
                                        <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $assignedAssets->count() }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900 dark:bg-opacity-30 rounded-lg">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-lg bg-green-100 dark:bg-green-800 mr-3">
                                        <i class="fas fa-history text-green-600 dark:text-green-300"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Assignments</p>
                                        <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $assignmentHistory->total() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Currently Assigned Assets -->
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-laptop mr-2"></i> Currently Assigned Assets
                            </h3>
                        </div>
                        <div class="p-6">
                            @if($assignedAssets->count() > 0)
                                <div class="space-y-4">
                                    @foreach($assignedAssets as $asset)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                                                <i class="fas fa-laptop text-blue-600 dark:text-blue-300"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $asset->name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    SN: {{ $asset->serial_number }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    Assigned: {{ \Carbon\Carbon::parse($asset->assigned_date)->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <form action="{{ route('employees.return-asset', [$employee, $asset]) }}" 
                                                  method="POST"
                                                  class="return-asset-form">
                                                @csrf
                                                <button type="button" 
                                                        class="return-asset-btn text-sm px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg"
                                                        data-asset-id="{{ $asset->id }}"
                                                        data-asset-name="{{ $asset->name }}">
                                                    Return
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-box-open text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400">No assets currently assigned</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Assign New Asset -->
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-plus-circle mr-2"></i> Assign New Asset
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('employees.assign-asset', $employee) }}" method="POST">
                                @csrf
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="asset_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Select Asset *
                                        </label>
                                        <select name="asset_id" 
                                                id="asset_id" 
                                                required
                                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                            <option value="">Select an asset</option>
                                            @foreach($availableAssets as $asset)
                                                <option value="{{ $asset->id }}">
                                                    {{ $asset->name }} ({{ $asset->serial_number }}) - {{ $asset->category->name ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="assigned_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Assignment Date *
                                        </label>
                                        <input type="date" 
                                               name="assigned_date" 
                                               id="assigned_date" 
                                               value="{{ date('Y-m-d') }}"
                                               required
                                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <div>
                                        <label for="condition_assigned" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Condition at Assignment *
                                        </label>
                                        <select name="condition_assigned" 
                                                id="condition_assigned" 
                                                required
                                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good" selected>Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Poor">Poor</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Notes
                                        </label>
                                        <textarea name="notes" 
                                                  id="notes" 
                                                  rows="3"
                                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                  placeholder="Any special instructions or notes..."></textarea>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit" 
                                                class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                                            Assign Asset to {{ $employee->name }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment History -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-history mr-2"></i> Assignment History
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($assignmentHistory->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                        <tr class="bg-gray-50 dark:bg-gray-700">
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Asset</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Assigned</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Returned</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Condition</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($assignmentHistory as $assignment)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                                        <i class="fas fa-laptop text-blue-600 dark:text-blue-300 text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white text-sm">
                                                            {{ $assignment->asset->name }}
                                                        </p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                                            {{ $assignment->asset->serial_number }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($assignment->assigned_date)->format('M d, Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                @if($assignment->return_date)
                                                    {{ \Carbon\Carbon::parse($assignment->return_date)->format('M d, Y') }}
                                                @else
                                                    <span class="text-yellow-600 dark:text-yellow-400">Currently Assigned</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex flex-col space-y-1">
                                                    <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                        Assigned: {{ $assignment->condition_assigned }}
                                                    </span>
                                                    @if($assignment->condition_returned)
                                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                        Returned: {{ $assignment->condition_returned }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                {{ $assignment->notes ?: 'N/A' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-4">
                                {{ $assignmentHistory->links() }}
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-history text-gray-400"></i>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400">No assignment history found</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Asset Modal -->
    <div id="returnModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Return Asset</h3>
                <form id="returnForm" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="return_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Return Date *
                            </label>
                            <input type="date" 
                                   name="return_date" 
                                   id="return_date" 
                                   value="{{ date('Y-m-d') }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        
                        <div>
                            <label for="condition_returned" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Condition at Return *
                            </label>
                            <select name="condition_returned" 
                                    id="condition_returned" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="Excellent">Excellent</option>
                                <option value="Good" selected>Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                                <option value="Damaged">Damaged</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="return_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Return Notes
                            </label>
                            <textarea name="return_notes" 
                                      id="return_notes" 
                                      rows="3"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                      placeholder="Any notes about the asset condition..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeReturnModal()"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                            Confirm Return
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const returnButtons = document.querySelectorAll('.return-asset-btn');
            
            returnButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const assetId = this.getAttribute('data-asset-id');
                    const assetName = this.getAttribute('data-asset-name');
                    const form = this.closest('.return-asset-form');
                    
                    // Update modal title
                    document.querySelector('#returnModal h3').textContent = `Return Asset: ${assetName}`;
                    
                    // Update form action
                    document.getElementById('returnForm').action = form.action;
                    
                    // Show modal
                    document.getElementById('returnModal').classList.remove('hidden');
                });
            });
        });
        
        function closeReturnModal() {
            document.getElementById('returnModal').classList.add('hidden');
        }
    </script>
</x-app-layout>