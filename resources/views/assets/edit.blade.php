<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-yellow-600 to-amber-700 -mx-8 -mt-2 px-8 py-4">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mr-3">
                    <i class="fas fa-edit text-white"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight">
                        {{ __('Edit Asset') }}
                    </h2>
                    <p class="text-yellow-200 text-sm">Update asset details</p>
                </div>
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
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-plus mr-3 text-gray-400"></i>
                            Add Asset
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tags mr-3 text-gray-400"></i>
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.create') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-plus-circle mr-3 text-gray-400"></i>
                            Add Category
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="py-8">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Form Card -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-white">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-box text-yellow-500 mr-2"></i> Asset Details
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Update the asset information below</p>
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
                            <form method="POST" action="{{ route('assets.update', $asset) }}">
                                @csrf
                                @method('PUT')

                                <!-- Asset Name -->
                                <div class="mb-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="text-red-500">*</span> Asset Name
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name', $asset->name) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                           placeholder="e.g., MacBook Pro, Office Chair, Projector"
                                           required
                                           autofocus>
                                    <p class="mt-1 text-sm text-gray-500">Enter a descriptive name for the asset</p>
                                </div>

                                <!-- Serial Number -->
                                <div class="mb-6">
                                    <label for="serial_number" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="text-red-500">*</span> Serial Number
                                    </label>
                                    <input type="text" 
                                           name="serial_number" 
                                           id="serial_number" 
                                           value="{{ old('serial_number', $asset->serial_number) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                           placeholder="e.g., SN123456789"
                                           required>
                                    <p class="mt-1 text-sm text-gray-500">Unique identifier for this asset</p>
                                </div>

                                <!-- Category -->
                                <div class="mb-6">
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="text-red-500">*</span> Category
                                    </label>
                                    <select name="category_id" 
                                            id="category_id"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                            required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-500">Select the category this asset belongs to</p>
                                </div>

                                <!-- Status -->
                                <div class="mb-6">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="text-red-500">*</span> Status
                                    </label>
                                    <select name="status" 
                                            id="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                            required>
                                        <option value="Available" {{ old('status', $asset->status) == 'Available' ? 'selected' : '' }}>Available</option>
                                        <option value="Assigned" {{ old('status', $asset->status) == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                                        <option value="Damaged" {{ old('status', $asset->status) == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                                        <option value="Lost" {{ old('status', $asset->status) == 'Lost' ? 'selected' : '' }}>Lost</option>
                                        <option value="Under Maintenance" {{ old('status', $asset->status) == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                    </select>
                                    <p class="mt-1 text-sm text-gray-500">Current status of the asset</p>
                                </div>

                                <!-- Purchase Information -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Purchase Date -->
                                    <div>
                                        <label for="purchase_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Purchase Date (Optional)
                                        </label>
                                        <input type="date" 
                                               name="purchase_date" 
                                               id="purchase_date" 
                                               value="{{ old('purchase_date', $asset->purchase_date ? $asset->purchase_date->format('Y-m-d') : '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                                    </div>

                                    <!-- Purchase Price -->
                                    <div>
                                        <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-2">
                                            Purchase Price (Optional)
                                        </label>
                                        <input type="number" 
                                               name="purchase_price" 
                                               id="purchase_price" 
                                               value="{{ old('purchase_price', $asset->purchase_price) }}"
                                               step="0.01"
                                               min="0"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                               placeholder="0.00">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-8">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description (Optional)
                                    </label>
                                    <textarea name="description" 
                                              id="description" 
                                              rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                              placeholder="Add any additional details about this asset...">{{ old('description', $asset->description) }}</textarea>
                                </div>

                                <!-- Is Active Checkbox -->
                                <div class="mb-8">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" 
                                               name="is_active" 
                                               value="1"
                                               class="rounded border-gray-300 text-yellow-600 shadow-sm focus:ring-yellow-500"
                                               {{ old('is_active', $asset->is_active ?? true) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">Mark this asset as active</span>
                                    </label>
                                    <p class="mt-1 text-sm text-gray-500">Inactive assets won't be available for assignment</p>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex flex-col sm:flex-row justify-between items-center pt-8 border-t border-gray-200">
                                    <div class="mb-4 sm:mb-0">
                                        <a href="{{ route('assets.show', $asset) }}" 
                                           class="inline-flex items-center px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                            <i class="fas fa-arrow-left mr-2"></i> Back to Asset
                                        </a>
                                    </div>
                                    <div class="flex space-x-3">
                                        
                                        <button type="submit" 
                                                class="inline-flex items-center px-6 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors shadow-md hover:shadow-lg">
                                            <i class="fas fa-save mr-2"></i> Update Asset
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
        </div>
    </div>
</x-app-layout>