<x-app-layout>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
            <div class="flex flex-col flex-1 min-h-0 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <!-- Sidebar header -->
                <div class="flex items-center h-16 flex-shrink-0 px-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-600 to-cyan-700">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-white bg-opacity-20 flex items-center justify-center mr-3">
                            <i class="fas fa-user-circle text-white"></i>
                        </div>
                        <span class="text-white font-semibold">User Profile</span>
                    </div>
                </div>
                
                <!-- Sidebar content -->
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <!-- Navigation -->
                    <nav class="flex-1 px-4 space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            <i class="fas fa-home mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300"></i>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                            <i class="fas fa-user-cog mr-3 flex-shrink-0 h-6 w-6 text-blue-500 dark:text-blue-400"></i>
                            Profile Settings
                        </a>
                        
                        <a href="{{ route('categories.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            <i class="fas fa-tags mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300"></i>
                            Categories
                        </a>
                        
                        <a href="{{ route('assets.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            <i class="fas fa-boxes mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300"></i>
                            Assets
                        </a>
                        
                        <a href="{{ route('employees.index') }}" 
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            <i class="fas fa-users mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300"></i>
                            Employees
                        </a>
                    </nav>
                    
                    <!-- User Info -->
                    <div class="px-4 mt-6">
                        <div class="p-4 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h4 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                Current User
                            </h4>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:pl-64 flex flex-col flex-1">
            <!-- Mobile sidebar toggle -->
            <div class="lg:hidden flex items-center h-16 px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <button type="button" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <i class="fas fa-bars h-6 w-6"></i>
                </button>
                <span class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">Profile Settings</span>
            </div>

            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow border-b border-gray-200 dark:border-gray-700">
                <div class="px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                <i class="fas fa-user-circle mr-2 text-blue-600"></i> Profile Settings
                            </h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Manage your account settings and preferences
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="py-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left Column: Profile Overview -->
                            <div class="lg:col-span-1">
                                <!-- User Card -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-6">
                                    <div class="p-6">
                                        <div class="text-center">
                                            <div class="inline-block relative">
                                                <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center mx-auto mb-4">
                                                    <i class="fas fa-user text-white text-5xl"></i>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h3>
                                            <p class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                            <div class="mt-4">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                    <i class="fas fa-circle text-green-500 mr-2" style="font-size: 8px;"></i>
                                                    Active Account
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <!-- Account Info -->
                                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                            <h4 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">
                                                Account Information
                                            </h4>
                                            <div class="space-y-3">
                                                <div class="flex items-center">
                                                    <i class="fas fa-calendar-alt text-gray-400 mr-3 w-5"></i>
                                                    <div>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">Member Since</p>
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ Auth::user()->created_at->format('M d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-clock text-gray-400 mr-3 w-5"></i>
                                                    <div>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">Last Updated</p>
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ Auth::user()->updated_at->format('M d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Links -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h4>
                                    <div class="space-y-3">
                                        <a href="{{ route('dashboard') }}" 
                                           class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                                <i class="fas fa-home text-blue-600 dark:text-blue-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">Dashboard</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Back to main dashboard</p>
                                            </div>
                                        </a>
                                        
                                        <a href="#" 
                                           class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                                                <i class="fas fa-history text-green-600 dark:text-green-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">Activity Log</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">View your account activity</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Profile Forms -->
                            <div class="lg:col-span-2 space-y-8">
                                <!-- Update Profile Information Card -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900 dark:to-cyan-900 dark:bg-opacity-20">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                                                <i class="fas fa-user-edit text-blue-600 dark:text-blue-400"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Profile Information</h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Update your account's profile information</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-profile-information-form')
                                        </div>
                                    </div>
                                </div>

                                <!-- Update Password Card -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 dark:bg-opacity-20">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center mr-4">
                                                <i class="fas fa-key text-green-600 dark:text-green-400"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Update Password</h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Ensure your account is using a long, random password to stay secure</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-password-form')
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Account Card -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900 dark:to-pink-900 dark:bg-opacity-20">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-red-100 dark:bg-red-900 flex items-center justify-center mr-4">
                                                <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Delete Account</h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Permanently delete your account</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="max-w-xl">
                                            @include('profile.partials.delete-user-form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Additional CSS -->
    <style>
        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }
        
        /* Card hover effects */
        .hover-lift {
            transition: transform 0.2s ease-in-out;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        
        /* Form focus styles */
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .dark .form-input:focus, .dark .form-textarea:focus, .dark .form-select:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }
    </style>
</x-app-layout>