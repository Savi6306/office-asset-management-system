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
                            New Assignment
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
                            <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center mr-3">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                            <div>
                                <h2 class="font-bold text-2xl text-gray-800">
                                    {{ __('Assign Asset to Employee') }}
                                </h2>
                                <p class="text-gray-600 text-sm">Create a new asset assignment</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-exchange-alt text-blue-500 mr-2"></i> Assignment Details
                            </h3>
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

                            <!-- Form -->
                            <form method="POST" action="{{ route('assignments.store') }}">
                                @csrf

                                <!-- Asset Selection -->
                                <div class="mb-6">
                                    <label for="asset_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="text-red-500">*</span> Select Asset
                                    </label>
                                    <select name="asset_id" 
                                            id="asset_id"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            required>
                                        <option value="">-- Available Assets --</option>
                                        @foreach($assets as $asset)
                                            <option value="{{ $asset->id }}" 
                                                {{ old('asset_id') == $asset->id ? 'selected' : '' }}
                                                data-category="{{ $asset->category->name ?? 'N/A' }}"
                                                data-serial="{{ $asset->serial_number }}">
                                                {{ $asset->name }} ({{ $asset->serial_number }})
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    <!-- Asset Details (Dynamic) -->
                                    <div id="asset-details" class="mt-4 p-4 bg-gray-50 rounded-lg hidden">
                                        <h4 class="font-medium text-gray-800 mb-2">Asset Details</h4>
                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <span class="text-gray-600">Category:</span>
                                                <span id="asset-category" class="font-medium ml-2">-</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Serial No:</span>
                                                <span id="asset-serial" class="font-medium ml-2">-</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Status:</span>
                                                <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Available</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Selection -->
                                <div class="mb-6">
                                    <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="text-red-500">*</span> Select Employee
                                    </label>
                                    <select name="employee_id" 
                                            id="employee_id"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            required>
                                        <option value="">-- Select Employee --</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                                data-department="{{ $employee->department }}"
                                                data-position="{{ $employee->position }}"
                                                data-assets="{{ $employee->assets_count }}">
                                                {{ $employee->name }} ({{ $employee->employee_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-500">Only active employees are shown</p>
                                    
                                    <!-- Employee Details (Dynamic) -->
                                    <div id="employee-details" class="mt-4 p-4 bg-gray-50 rounded-lg hidden">
                                        <h4 class="font-medium text-gray-800 mb-2">Employee Details</h4>
                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <span class="text-gray-600">Department:</span>
                                                <span id="employee-department" class="font-medium ml-2">-</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Position:</span>
                                                <span id="employee-position" class="font-medium ml-2">-</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Current Assets:</span>
                                                <span id="employee-assets" class="font-medium ml-2">0</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Status:</span>
                                                <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!-- Add this after Employee Selection section and before Dates Section -->

<!-- Status Selection -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-3">
        <span class="text-red-500">*</span> Assignment Status
    </label>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Active -->
        <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all duration-300 hover:shadow-md hover:border-green-400
            {{ old('status', 'active') == 'active' ? 'border-green-500 bg-green-50' : 'border-gray-300' }}">
            <input type="radio" 
                   name="status" 
                   value="active" 
                   {{ old('status', 'active') == 'active' ? 'checked' : '' }}
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
            {{ old('status') == 'returned' ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
            <input type="radio" 
                   name="status" 
                   value="returned" 
                   {{ old('status') == 'returned' ? 'checked' : '' }}
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
            {{ old('status') == 'cancelled' ? 'border-red-500 bg-red-50' : 'border-gray-300' }}">
            <input type="radio" 
                   name="status" 
                   value="cancelled" 
                   {{ old('status') == 'cancelled' ? 'checked' : '' }}
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

                                <!-- Dates Section -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Assigned Date -->
                                    <div>
                                        <label for="assigned_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            <span class="text-red-500">*</span> Assigned Date
                                        </label>
                                        <input type="date" 
                                               name="assigned_date" 
                                               id="assigned_date" 
                                               value="{{ old('assigned_date', now()->toDateString()) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               required>
                                    </div>

                                    <!-- Return Date -->
                                    <div>
                                        <label for="return_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Expected Return Date (Optional)
                                        </label>
                                        <input type="date" 
                                               name="return_date" 
                                               id="return_date" 
                                               value="{{ old('return_date') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="mb-8">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                        Notes (Optional)
                                    </label>
                                    <textarea name="notes" 
                                              id="notes" 
                                              rows="4"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                              placeholder="Add any notes, conditions, or special instructions for this assignment...">{{ old('notes') }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Max 500 characters</p>
                                </div>

                                <!-- Summary Preview -->
                                <div id="assignment-summary" class="mb-8 p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                                    <h4 class="font-semibold text-blue-800 mb-3 flex items-center">
                                        <i class="fas fa-clipboard-check mr-2"></i> Assignment Summary
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-white p-3 rounded-lg border">
                                            <span class="text-gray-600">Asset:</span>
                                            <span id="summary-asset" class="font-medium ml-2">Not selected</span>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg border">
                                            <span class="text-gray-600">Employee:</span>
                                            <span id="summary-employee" class="font-medium ml-2">Not selected</span>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg border">
                                            <span class="text-gray-600">Assigned Date:</span>
                                            <span id="summary-assigned-date" class="font-medium ml-2">{{ now()->format('M d, Y') }}</span>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg border">
                                            <span class="text-gray-600">Return Date:</span>
                                            <span id="summary-return-date" class="font-medium ml-2 text-gray-400">Not set</span>
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
                                                id="submit-btn"
                                                class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                                            <i class="fas fa-handshake mr-2"></i> Create Assignment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- Available Assets & Employees Stats -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Available Assets</h4>
                            <p class="text-2xl font-bold text-blue-600">{{ $assets->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Ready for assignment</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Active Employees</h4>
                            <p class="text-2xl font-bold text-green-600">{{ $employees->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Can receive assets</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Recent Assignments</h4>
                            <p class="text-2xl font-bold text-purple-600">{{ \App\Models\Assignment::count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Total assignments made</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const assetSelect = document.getElementById('asset_id');
            const employeeSelect = document.getElementById('employee_id');
            const assignedDateInput = document.getElementById('assigned_date');
            const returnDateInput = document.getElementById('return_date');
            const submitBtn = document.getElementById('submit-btn');
            
            // Asset details display
            const assetDetails = document.getElementById('asset-details');
            const assetCategory = document.getElementById('asset-category');
            const assetSerial = document.getElementById('asset-serial');
            
            // Employee details display
            const employeeDetails = document.getElementById('employee-details');
            const employeeDept = document.getElementById('employee-department');
            const employeePosition = document.getElementById('employee-position');
            const employeeAssets = document.getElementById('employee-assets');
            
            // Summary display
            const summaryBox = document.getElementById('assignment-summary');
            const summaryAsset = document.getElementById('summary-asset');
            const summaryEmployee = document.getElementById('summary-employee');
            const summaryAssignedDate = document.getElementById('summary-assigned-date');
            const summaryReturnDate = document.getElementById('summary-return-date');
            
            // Asset selection change
            assetSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                
                if (selectedOption.value) {
                    assetDetails.classList.remove('hidden');
                    assetCategory.textContent = selectedOption.dataset.category;
                    assetSerial.textContent = selectedOption.dataset.serial;
                    summaryAsset.textContent = selectedOption.text;
                } else {
                    assetDetails.classList.add('hidden');
                    summaryAsset.textContent = 'Not selected';
                }
                updateSummary();
                validateForm();
            });
            
            // Employee selection change
            employeeSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                
                if (selectedOption.value) {
                    employeeDetails.classList.remove('hidden');
                    employeeDept.textContent = selectedOption.dataset.department;
                    employeePosition.textContent = selectedOption.dataset.position;
                    employeeAssets.textContent = selectedOption.dataset.assets;
                    summaryEmployee.textContent = selectedOption.text;
                } else {
                    employeeDetails.classList.add('hidden');
                    summaryEmployee.textContent = 'Not selected';
                }
                updateSummary();
                validateForm();
            });
            
            // Date changes
            assignedDateInput.addEventListener('change', updateSummary);
            returnDateInput.addEventListener('change', updateSummary);
            
            // Update summary function
            function updateSummary() {
                // Show summary if asset or employee is selected
                if (assetSelect.value || employeeSelect.value) {
                    summaryBox.classList.remove('hidden');
                } else {
                    summaryBox.classList.add('hidden');
                }
                
                // Update dates
                if (assignedDateInput.value) {
                    const date = new Date(assignedDateInput.value);
                    summaryAssignedDate.textContent = date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                }
                
                if (returnDateInput.value) {
                    const date = new Date(returnDateInput.value);
                    summaryReturnDate.textContent = date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                    summaryReturnDate.classList.remove('text-gray-400');
                } else {
                    summaryReturnDate.textContent = 'Not set';
                    summaryReturnDate.classList.add('text-gray-400');
                }
            }
            
            // Form validation
            function validateForm() {
                const isValid = assetSelect.value && employeeSelect.value && assignedDateInput.value;
                
                submitBtn.disabled = !isValid;
                
                if (isValid) {
                    submitBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
                } else {
                    submitBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
                }
            }
            
            // Set min date for return date to assigned date
            assignedDateInput.addEventListener('change', function() {
                returnDateInput.min = this.value;
                if (returnDateInput.value && returnDateInput.value < this.value) {
                    returnDateInput.value = this.value;
                }
            });
            
            // Initialize validation
            validateForm();
            
            // Auto-show details if values are pre-filled (from validation errors)
            if (assetSelect.value) {
                assetSelect.dispatchEvent(new Event('change'));
            }
            if (employeeSelect.value) {
                employeeSelect.dispatchEvent(new Event('change'));
            }
            
            // Set today's date as default for assigned date
            if (!assignedDateInput.value) {
                assignedDateInput.value = new Date().toISOString().split('T')[0];
            }
            
            // Set min date for assigned date to today
            assignedDateInput.min = new Date().toISOString().split('T')[0];
            
            // Confirm before submit
            document.querySelector('form').addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to create this assignment?')) {
                    e.preventDefault();
                    return false;
                }
                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Creating...';
            });
        });
    </script>
</x-app-layout>