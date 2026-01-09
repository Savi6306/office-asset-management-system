<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-50 border-r border-gray-200 min-h-screen">
            <div class="p-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">
                
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assets.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-box mr-3 text-gray-400"></i>
                            All Assets
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assets.create') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-plus mr-3 text-gray-400"></i>
                            Add Asset
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employees.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-users mr-3 text-gray-400"></i>
                            Employees
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assignments.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-exchange-alt mr-3 text-gray-400"></i>
                            Assignments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assignments.create') }}" 
                           class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fas fa-handshake mr-3 text-blue-500"></i>
                        Edit Assignment
                        </a>
                    </li>
                </ul>
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

        <!-- Main Content -->
        <div class="flex-1">
            <div class="py-8">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Header -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-yellow-600 flex items-center justify-center mr-3">
                                <i class="fas fa-edit text-white"></i>
                            </div>
                            <div>
                                <h2 class="font-bold text-2xl text-gray-800">
                                    {{ __('Edit Assignment') }}
                                </h2>
                                <p class="text-gray-600 text-sm">Update assignment details</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-white">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-edit text-yellow-500 mr-2"></i> Edit Assignment Details
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Update assignment information and status</p>
                        </div>
                        
                        <div class="p-6">
                            @if ($errors->any())
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span class="font-medium">Please fix the following errors:</span>
                                </div>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Current Assignment Info -->
                            <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <h4 class="font-semibold text-blue-800 mb-2">Current Assignment</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <span class="text-gray-600">Asset:</span>
                                        <span class="font-medium ml-2">{{ $assignment->asset->name }}</span>
                                        <div class="text-xs text-gray-500">SN: {{ $assignment->asset->serial_number }}</div>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Employee:</span>
                                        <span class="font-medium ml-2">{{ $assignment->employee->name }}</span>
                                        <div class="text-xs text-gray-500">{{ $assignment->employee->department }}</div>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Current Status:</span>
                                        <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($assignment->status == 'active') bg-green-100 text-green-800
                                            @elseif($assignment->status == 'returned') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($assignment->status) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Assigned On:</span>
                                        <span class="font-medium ml-2">{{ $assignment->assigned_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Form -->
                            <form method="POST" action="{{ route('assignments.update', $assignment) }}">
                                @csrf
                                @method('PUT')

                                <!-- Status Selection -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <span class="text-red-500">*</span> Update Status
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Active -->
                                        <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all duration-300 hover:shadow-md hover:border-green-400
                                            {{ old('status', $assignment->status) == 'active' ? 'border-green-500 bg-green-50' : 'border-gray-300' }}">
                                            <input type="radio" 
                                                   name="status" 
                                                   value="active" 
                                                   {{ old('status', $assignment->status) == 'active' ? 'checked' : '' }}
                                                   class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300">
                                            <div class="ml-3 flex-1">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <span class="block text-sm font-semibold text-gray-900">Active</span>
                                                        <span class="block text-xs text-gray-500 mt-1">Asset is currently assigned</span>
                                                    </div>
                                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                                </div>
                                            </div>
                                        </label>

                                        <!-- Returned -->
                                        <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all duration-300 hover:shadow-md hover:border-blue-400
                                            {{ old('status', $assignment->status) == 'returned' ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                                            <input type="radio" 
                                                   name="status" 
                                                   value="returned" 
                                                   {{ old('status', $assignment->status) == 'returned' ? 'checked' : '' }}
                                                   class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <div class="ml-3 flex-1">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <span class="block text-sm font-semibold text-gray-900">Returned</span>
                                                        <span class="block text-xs text-gray-500 mt-1">Asset has been returned</span>
                                                    </div>
                                                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                                                </div>
                                            </div>
                                        </label>

                                        <!-- Cancelled -->
<label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all duration-300 hover:shadow-md hover:border-red-400
    {{ old('status', $assignment->status) == 'damaged' ? 'border-red-500 bg-red-50' : 'border-gray-300' }}">
    
    <input type="radio" 
           name="status" 
           value="damaged" 
           {{ old('status', $assignment->status) == 'damaged' ? 'checked' : '' }}
           class="h-5 w-5 text-red-600 focus:ring-red-500 border-gray-300">
           
    <div class="ml-3 flex-1">
        <div class="flex justify-between items-center">
            <div>
                <span class="block text-sm font-semibold text-gray-900">Damaged</span>
                <span class="block text-xs text-gray-500 mt-1">Damaged by Employee</span>
            </div>
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
        </div>
    </div>
</label>
                                    </div>
                                </div>

                                <!-- Return Date Update -->
                                <div class="mb-6">
                                    <label for="return_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Update Return Date
                                    </label>
                                    <input type="date" 
                                           name="return_date" 
                                           id="return_date" 
                                           value="{{ old('return_date', $assignment->return_date ? $assignment->return_date->format('Y-m-d') : '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                                    <p class="mt-1 text-sm text-gray-500">Update if asset has been returned</p>
                                </div>

                                <!-- Notes Update -->
                                <div class="mb-8">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                        Update Notes
                                    </label>
                                    <textarea name="notes" 
                                              id="notes" 
                                              rows="4"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                              placeholder="Add update notes...">{{ old('notes', $assignment->notes) }}</textarea>
                                </div>

                                <!-- Asset Status Change Warning -->
                                <div id="status-warning" class="mb-6 p-4 border rounded-lg hidden">
                                    <div class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                                        <div>
                                            <h4 class="font-medium text-yellow-800">Asset Status Will Change</h4>
                                            <p class="text-sm text-yellow-700 mt-1">
                                                Changing status to <span id="new-status-text" class="font-semibold"></span> will mark the asset as 
                                                <span id="asset-status-change" class="font-semibold"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex flex-col sm:flex-row justify-between items-center pt-8 border-t border-gray-200">
                                    <div class="mb-4 sm:mb-0">
                                        <a href="{{ route('assignments.index') }}" 
                                           class="inline-flex items-center px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                            <i class="fas fa-arrow-left mr-2"></i> Back to Assignments
                                        </a>
                                    </div>
                        
                                        <button type="submit" 
                                                class="inline-flex items-center px-6 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors shadow-md hover:shadow-lg">
                                            <i class="fas fa-save mr-2"></i> Update Assignment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusRadios = document.querySelectorAll('input[name="status"]');
            const warningBox = document.getElementById('status-warning');
            const newStatusText = document.getElementById('new-status-text');
            const assetStatusChange = document.getElementById('asset-status-change');
            const currentStatus = '{{ $assignment->status }}';
            
            statusRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value !== currentStatus) {
                        warningBox.classList.remove('hidden');
                        warningBox.classList.add('border-yellow-300', 'bg-yellow-50');
                        
                        // Update warning text
                        newStatusText.textContent = this.value;
                        
                        // Determine asset status change
                        if (this.value === 'active') {
                            assetStatusChange.textContent = 'Assigned';
                        } else {
                            assetStatusChange.textContent = 'Available';
                        }
                    } else {
                        warningBox.classList.add('hidden');
                    }
                });
            });
            
            // Trigger change on page load if status is different
            const selectedRadio = document.querySelector('input[name="status"]:checked');
            if (selectedRadio && selectedRadio.value !== currentStatus) {
                selectedRadio.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>