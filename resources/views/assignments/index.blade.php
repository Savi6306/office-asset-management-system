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
                           class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fas fa-exchange-alt mr-3 text-blue-500"></i>
                            Assignments
                        </a>
                        <a href="{{ route('categories.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tags mr-3 text-gray-400"></i>
                            Categories
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
                                    <i class="fas fa-exchange-alt mr-2 text-blue-600"></i>Asset Assignments
                                </h2>
                                <p class="text-gray-600 text-sm mt-1">Manage asset assignments to employees</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <!-- New Assignment -->
                                <a href="{{ route('assignments.create') }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:shadow-lg transition-shadow">
                                    <i class="fas fa-handshake mr-2"></i> New Assignment
                                </a>
                                <!-- Back to Dashboard -->
                                <a href="{{ route('dashboard') }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 mr-4">
                                    <i class="fas fa-exchange-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Assignments</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Assignment::count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 mr-4">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Active</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ \App\Models\Assignment::where('status', 'active')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 mr-4">
                                    <i class="fas fa-undo text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Returned</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ \App\Models\Assignment::where('status', 'returned')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                     <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
    <div class="flex items-center">
        <div class="p-3 rounded-full bg-red-100 mr-4">
            <i class="fas fa-exclamation-triangle text-red-600"></i>
        </div>
        <div>
            <p class="text-sm text-gray-600">Damaged Assets</p>
            <p class="text-2xl font-bold text-gray-900">
                {{ \App\Models\Assignment::where('status', 'damaged')->count() }}
            </p>
        </div>
    </div>
</div>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    <!-- Assignments Table -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <!-- Search and Filters -->
                            <div class="mb-4 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">All Assignments</h3>
                                </div>
                                <div class="flex space-x-2">
                                    <input type="text" 
                                           placeholder="Search assignments..." 
                                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="returned">Returned</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-hashtag mr-1"></i> ID
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-box mr-1"></i> Asset
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-user mr-1"></i> Employee
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-calendar-alt mr-1"></i> Assigned Date
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-calendar-check mr-1"></i> Return Date
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-tag mr-1"></i> Status
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-cogs mr-1"></i> Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($assignments as $assignment)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #{{ $assignment->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                        <i class="fas fa-box text-blue-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $assignment->asset->name ?? 'N/A' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            SN: {{ $assignment->asset->serial_number ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-green-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $assignment->employee->name ?? 'N/A' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ $assignment->employee->department ?? '' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($assignment->assigned_date)->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($assignment->return_date)
                                                    {{ \Carbon\Carbon::parse($assignment->return_date)->format('M d, Y') }}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($assignment->status == 'active')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <i class="fas fa-circle text-green-500 mr-1" style="font-size: 8px;"></i> Active
                                                </span>
                                                @elseif($assignment->status == 'returned')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    <i class="fas fa-circle text-blue-500 mr-1" style="font-size: 8px;"></i> Returned
                                                </span>
                                                @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    <i class="fas fa-circle text-red-500 mr-1" style="font-size: 8px;"></i> Cancelled
                                                </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center space-x-2">
                                                    <!-- View -->
                                                    <a href="{{ route('assignments.show', $assignment) }}"
                                                       class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded hover:bg-blue-50"
                                                       title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <!-- Edit -->
                                                    <a href="{{ route('assignments.edit', $assignment) }}"
                                                       class="text-green-600 hover:text-green-900 px-2 py-1 rounded hover:bg-green-50"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <!-- Delete -->
                                                    <form action="{{ route('assignments.destroy', $assignment) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this assignment?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-900 px-2 py-1 rounded hover:bg-red-50"
                                                                title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <!-- Quick Actions -->
                                                    @if($assignment->status == 'active')
                                                    <form action="{{ route('assignments.update', $assignment) }}"
                                                          method="POST"
                                                          class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="returned">
                                                        <input type="hidden" name="return_date" value="{{ now()->toDateString() }}">
                                                        <button type="submit"
                                                                class="text-purple-600 hover:text-purple-900 px-2 py-1 rounded hover:bg-purple-50"
                                                                title="Mark as Returned">
                                                            <i class="fas fa-undo"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-12 text-center">
                                                <div class="text-gray-500">
                                                    <i class="fas fa-exchange-alt text-4xl mb-4 opacity-20"></i>
                                                    <p class="text-lg font-medium mb-2">No assignments found</p>
                                                    <p class="mb-4">Start by assigning assets to employees</p>
                                                    <a href="{{ route('assignments.create') }}" 
                                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                                        <i class="fas fa-handshake mr-2"></i> Create First Assignment
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            @if($assignments->hasPages())
                            <div class="mt-6">
                                {{ $assignments->links() }}
                            </div>
                            @endif
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <script>
        // Quick return functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Confirm before marking as returned
            const returnButtons = document.querySelectorAll('[title="Mark as Returned"]');
            returnButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Mark this assignment as returned?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>