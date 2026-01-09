<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center mr-3">
                <i class="fas fa-plus text-white"></i>
            </div>
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Add New Asset') }}
                </h2>
                <p class="text-gray-600 text-sm">Register a new office asset</p>
            </div>
        </div>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-50 border-r border-gray-200 min-h-screen">
            <div class="p-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">
                    Navigation
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
                           class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fas fa-plus mr-3 text-blue-500"></i>
                            Add Asset
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
            <div class="py-6">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Form Card -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-bold text-gray-900">Asset Details</h3>
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
                            <form method="POST" action="{{ route('assets.store') }}">
                                @csrf

                                <!-- Asset Name -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Asset Name
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="e.g., Dell Laptop"
                                           required>
                                </div>

                                <!-- Serial Number -->
                                <div class="mb-4">
                                    <label for="serial_number" class="block text-sm font-medium text-gray-700 mb-2">
                                        Serial Number
                                    </label>
                                    <input type="text" 
                                           name="serial_number" 
                                           id="serial_number" 
                                           value="{{ old('serial_number') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="e.g., DL-001"
                                           required>
                                </div>

                                <!-- Category -->
                                <div class="mb-4">
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        Category
                                    </label>
                                    <select name="category_id" 
                                            id="category_id"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Status
                                    </label>
                                    <div class="flex space-x-4">
                                        <label class="flex items-center">
                                            <input type="radio" 
                                                   name="status" 
                                                   value="Available" 
                                                   {{ old('status', 'Available') == 'Available' ? 'checked' : '' }}
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-gray-700">Available</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" 
                                                   name="status" 
                                                   value="Assigned" 
                                                   {{ old('status') == 'Assigned' ? 'checked' : '' }}
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-gray-700">Assigned</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" 
                                                   name="status" 
                                                   value="Damaged" 
                                                   {{ old('status') == 'Damaged' ? 'checked' : '' }}
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-gray-700">Damaged</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description (Optional)
                                    </label>
                                    <textarea name="description" 
                                              id="description" 
                                              rows="3"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="Additional details...">{{ old('description') }}</textarea>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                                    <a href="{{ route('dashboard') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                                    </a>
                                    <button type="submit" 
                                            class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
                                        <i class="fas fa-save mr-2"></i> Save Asset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>