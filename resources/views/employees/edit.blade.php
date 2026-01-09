<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <i class="fas fa-edit mr-2"></i>Edit Employee
            </h2>
            <a href="{{ route('employees.show', $employee) }}" 
               class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                <i class="fas fa-arrow-left mr-2"></i> Back to Details
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('employees.update', $employee) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Employee ID (readonly) -->
                            <div>
                                <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Employee ID
                                </label>
                                <input type="text" 
                                       value="{{ $employee->employee_id }}"
                                       readonly
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Employee ID cannot be changed</p>
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Full Name *
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $employee->name) }}"
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Email Address *
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $employee->email) }}"
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Phone Number
                                </label>
                                <input type="text" 
                                       name="phone" 
                                       id="phone" 
                                       value="{{ old('phone', $employee->phone) }}"
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <!-- Department -->
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Department *
                                </label>
                                <select name="department" 
                                        id="department" 
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department }}" {{ old('department', $employee->department) == $department ? 'selected' : '' }}>
                                            {{ $department }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Position *
                                </label>
                                <input type="text" 
                                       name="position" 
                                       id="position" 
                                       value="{{ old('position', $employee->position) }}"
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Status *
                                </label>
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ old('status', $employee->status) == $status ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Address -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Address
                                </label>
                                <textarea name="address" 
                                          id="address" 
                                          rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('address', $employee->address) }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('employees.show', $employee) }}" 
                               class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>