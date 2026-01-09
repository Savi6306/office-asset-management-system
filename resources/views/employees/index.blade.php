<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-50 border-r border-gray-200 min-h-screen">
            <div class="p-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                       <a href="{{ route('assets.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-boxes mr-3 text-sm"></i>
                            <span class="font-medium">Assets</span>
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
                        <a href="{{ route('employees.index') }}" 
                           class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fas fa-users mr-3 text-blue-500"></i>
                            Employees
                        </a>
                         <a href="{{ route('assignments.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <i class="fas fa-handshake mr-3 text-sm"></i>
                            <span class="font-medium">Assignments</span>
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
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Header -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    <i class="fas fa-users mr-2 text-blue-600"></i>Manage Employees
                                </h2>
                                <p class="text-gray-600 text-sm mt-1">View and manage all employees</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <!-- Add New Employee -->
                                <a href="{{ route('employees.create') }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                    <i class="fas fa-plus mr-2"></i> Add New Employee
                                </a>
                                <!-- Back to Dashboard -->
                                <a href="{{ route('dashboard') }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 mr-4">
                                    <i class="fas fa-users text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Employees</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $employees->total() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 mr-4">
                                    <i class="fas fa-user-check text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Active Employees</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ \App\Models\Employee::where('status', 'active')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 mr-4">
                                    <i class="fas fa-user-clock text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">On Leave</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ \App\Models\Employee::where('status', 'on_leave')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 mr-4">
                                    <i class="fas fa-user-slash text-red-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Inactive</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ \App\Models\Employee::where('status', 'inactive')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employees Table -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Assets</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($employees as $employee)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                            <i class="fas fa-user text-blue-600"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $employee->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $employee->employee_id }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $employee->department }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $employee->position }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center">
                                                    <i class="fas fa-laptop mr-2 text-gray-500"></i>
                                                    {{ $employee->assets_count }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($employee->status == 'active')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                                @elseif($employee->status == 'on_leave')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    On Leave
                                                </span>
                                                @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Inactive
                                                </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center gap-2">
                                                    <!-- View -->
                                                    <a href="{{ route('employees.show', $employee) }}"
                                                       class="px-3 py-1.5 rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200"
                                                       title="View">
                                                        <i class="fas fa-eye"></i> Show
                                                    </a>

                                                    <!-- Edit -->
                                                    <a href="{{ route('employees.edit', $employee) }}"
                                                       class="px-3 py-1.5 rounded-md bg-green-100 text-green-700 hover:bg-green-200"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('employees.destroy', $employee) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="px-3 py-1.5 rounded-md bg-red-100 text-red-700 hover:bg-red-200"
                                                                title="Delete">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $employees->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>