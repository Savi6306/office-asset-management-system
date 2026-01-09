<x-app-layout>
    <div class="flex min-h-screen bg-slate-50 dark:bg-gray-900" x-data="{ sidebarOpen: true }">
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed inset-y-0 left-0 z-50 transition-all duration-300 bg-slate-800 dark:bg-gray-800 text-slate-300 shadow-xl overflow-hidden hidden lg:flex flex-col">
            <div class="flex items-center justify-center h-16 bg-slate-900 border-b border-slate-700">
                <i class="fas fa-microchip text-indigo-400 text-2xl"></i>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p x-show="sidebarOpen" class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>
                
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
                    <i class="fas fa-exchange-alt w-6 group-hover:text-indigo-400"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium">Assignments</span>
                </a>
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

        <main :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 transition-all duration-300">
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-slate-200 dark:border-gray-700 sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-indigo-600 focus:outline-none mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="font-bold text-xl text-slate-800 dark:text-white leading-tight">
                            {{ __('Edit Category') }}
                        </h2>
                    </div>
                </div>
            </header>

            <div class="py-12 px-6 lg:px-8 max-w-4xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <span class="w-1.5 h-8 bg-indigo-600 rounded-full mr-4"></span>
                            <h3 class="text-2xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
                                {{ $category->name }}
                            </h3>
                        </div>
                        
                        <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2" for="name">
                                    Category Name
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="w-full rounded-xl border-slate-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4"
                                    value="{{ old('name', $category->name) }}"
                                    placeholder="Enter category name..."
                                    required
                                    autofocus
                                />
                                @error('name')
                                    <p class="text-rose-500 text-xs font-bold mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-50">
                                                         <a href="{{ route('assets.index') }}"
       class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold
              bg-black bg-opacity-10 text-white border border-white border-opacity-20
              hover:bg-white hover:text-indigo-700 transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to Assets
    </a>
                                <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-indigo-200 transition-all">
                                    Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</x-app-layout>