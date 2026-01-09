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
                        <a href="{{ route('assignments.index') }}" 
                           class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fas fa-exchange-alt mr-3 text-blue-500"></i>
                            Assignments
                        </a>
                    </li>
                </ul>
                 <a href="{{ route('categories.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tags mr-3 text-gray-400"></i>
                            Categories
                        </a>
                         <a href="{{ route('employees.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-users mr-3 text-gray-400"></i>
                            Employees
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
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Header with Actions -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-eye text-white"></i>
                                </div>
                                <div>
                                    <h2 class="font-bold text-2xl text-gray-800">
                                        Assignment Details
                                    </h2>
                                    <p class="text-gray-600 text-sm">View complete assignment information</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('assignments.edit', $assignment) }}" 
                                   class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:shadow-lg transition-shadow">
                                    <i class="fas fa-edit mr-2"></i> Edit Assignment
                                </a>
                                <!-- Back Button -->
                                <a href="{{ route('assignments.index') }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                                </a>
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

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column - Assignment Info -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Assignment Details Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                        <i class="fas fa-info-circle text-blue-500 mr-2"></i> Assignment Information
                                    </h3>
                                </div>
                                
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Assignment ID -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Assignment ID</label>
                                            <p class="text-lg font-semibold text-gray-800">#{{ $assignment->id }}</p>
                                        </div>
                                        
                                        <!-- Status -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                            @if($assignment->status == 'active')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                                <i class="fas fa-circle text-green-500 mr-1" style="font-size: 8px;"></i> Active
                                            </span>
                                            @elseif($assignment->status == 'returned')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                                <i class="fas fa-circle text-blue-500 mr-1" style="font-size: 8px;"></i> Returned
                                            </span>
                                            @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                                <i class="fas fa-circle text-red-500 mr-1" style="font-size: 8px;"></i> Cancelled
                                            </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Assigned Date -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Assigned Date</label>
                                            <div class="flex items-center text-gray-800">
                                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                                <span class="font-medium">{{ $assignment->assigned_date->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Return Date -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Return Date</label>
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-check text-gray-400 mr-2"></i>
                                                @if($assignment->return_date)
                                                <span class="font-medium text-gray-800">{{ $assignment->return_date->format('M d, Y') }}</span>
                                                @else
                                                <span class="text-gray-400 italic">Not set</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Created At -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Created On</label>
                                            <div class="flex items-center text-gray-800">
                                                <i class="fas fa-clock text-gray-400 mr-2"></i>
                                                <span class="font-medium">{{ $assignment->created_at->format('M d, Y, h:i A') }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Last Updated -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                            <div class="flex items-center text-gray-800">
                                                <i class="fas fa-sync-alt text-gray-400 mr-2"></i>
                                                <span class="font-medium">{{ $assignment->updated_at->format('M d, Y, h:i A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Notes Section -->
                                    @if($assignment->notes)
                                    <div class="mt-6 pt-6 border-t border-gray-200">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="text-gray-700 whitespace-pre-line">{{ $assignment->notes }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- History Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                        <i class="fas fa-history text-gray-500 mr-2"></i> Assignment History
                                    </h3>
                                </div>
                                
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <!-- Creation Event -->
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <i class="fas fa-plus text-blue-600 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Assignment Created</p>
                                                <p class="text-sm text-gray-500">
                                                    Asset assigned to employee on {{ $assignment->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                            <div class="ml-auto text-sm text-gray-400">
                                                {{ $assignment->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        
                                        <!-- Status Changes -->
                                        @if($assignment->updated_at != $assignment->created_at)
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                                    <i class="fas fa-edit text-yellow-600 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                                <p class="text-sm text-gray-500">
                                                    Assignment details were modified
                                                </p>
                                            </div>
                                            <div class="ml-auto text-sm text-gray-400">
                                                {{ $assignment->updated_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <!-- Expected Return -->
                                        @if($assignment->return_date && $assignment->status == 'active')
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                    <i class="fas fa-calendar text-green-600 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Expected Return</p>
                                                <p class="text-sm text-gray-500">
                                                    Asset should be returned by {{ $assignment->return_date->format('M d, Y') }}
                                                </p>
                                            </div>
                                            @php
                                                $daysLeft = \Carbon\Carbon::parse($assignment->return_date)->diffInDays(now(), false) * -1;
                                            @endphp
                                            <div class="ml-auto">
                                                @if($daysLeft > 0)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $daysLeft }} days left
                                                </span>
                                                @elseif($daysLeft == 0)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Due today
                                                </span>
                                                @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Overdue by {{ abs($daysLeft) }} days
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Asset & Employee Info -->
                        <div class="space-y-6">
                            <!-- Asset Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-white">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                        <i class="fas fa-box text-purple-500 mr-2"></i> Asset Details
                                    </h3>
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex items-start mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                                <i class="fas fa-box text-purple-600 text-xl"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $assignment->asset->name ?? 'N/A' }}</h4>
                                            <p class="text-sm text-gray-500">SN: {{ $assignment->asset->serial_number ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Category:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $assignment->asset->category->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Asset Status:</span>
                                            @if($assignment->asset->status == 'Available')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Available
                                            </span>
                                            @elseif($assignment->asset->status == 'Assigned')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Assigned
                                            </span>
                                            @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Damaged
                                            </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Description:</span>
                                            <span class="text-sm text-gray-900 text-right">
                                                {{ Str::limit($assignment->asset->description ?? 'No description', 30) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <a href="{{ route('assets.show', $assignment->asset) }}" 
                                           class="block w-full text-center bg-purple-50 hover:bg-purple-100 text-purple-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-external-link-alt mr-2"></i> View Full Asset Details
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Employee Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-green-50 to-white">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                        <i class="fas fa-user text-green-500 mr-2"></i> Employee Details
                                    </h3>
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex items-start mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-user text-green-600 text-xl"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $assignment->employee->name ?? 'N/A' }}</h4>
                                            <p class="text-sm text-gray-500">ID: {{ $assignment->employee->employee_id ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Department:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $assignment->employee->department ?? 'N/A' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Position:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $assignment->employee->position ?? 'N/A' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Email:</span>
                                            <span class="text-sm text-gray-900">
                                                {{ $assignment->employee->email ?? 'N/A' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Phone:</span>
                                            <span class="text-sm text-gray-900">
                                                {{ $assignment->employee->phone ?? 'N/A' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Status:</span>
                                            @if($assignment->employee->status == 'active')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                            @elseif($assignment->employee->status == 'on_leave')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                On Leave
                                            </span>
                                            @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <a href="{{ route('employees.show', $assignment->employee) }}" 
                                           class="block w-full text-center bg-green-50 hover:bg-green-100 text-green-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-external-link-alt mr-2"></i> View Employee Profile
                                        </a>
                                    </div>
                                </div>
                            </div>

                            
                   

                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <style>
        @media print {
            .sidebar, .actions, .print-hide {
                display: none !important;
            }
            body {
                background: white;
            }
            .container {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
            }
            .card {
                border: 1px solid #ccc;
                box-shadow: none;
                margin-bottom: 20px;
                page-break-inside: avoid;
            }
        }
        
        .assignment-details {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add confirmation for all form submissions
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton && !form.hasAttribute('data-confirmed')) {
                    form.addEventListener('submit', function(e) {
                        if (submitButton.hasAttribute('data-confirmed')) return;
                        
                        const action = submitButton.textContent.trim();
                        if (!confirm(`Are you sure you want to ${action}?`)) {
                            e.preventDefault();
                        } else {
                            submitButton.disabled = true;
                            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
                        }
                    });
                }
            });
            
            // Calculate and update days left
            function updateDaysLeft() {
                const returnDateElement = document.querySelector('[data-return-date]');
                if (returnDateElement) {
                    const returnDate = new Date(returnDateElement.dataset.returnDate);
                    const today = new Date();
                    const daysLeft = Math.ceil((returnDate - today) / (1000 * 60 * 60 * 24));
                    
                    const daysElement = document.getElementById('days-left');
                    if (daysElement) {
                        if (daysLeft > 0) {
                            daysElement.textContent = `${daysLeft} days left`;
                            daysElement.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                        } else if (daysLeft === 0) {
                            daysElement.textContent = 'Due today';
                            daysElement.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800';
                        } else {
                            daysElement.textContent = `Overdue by ${Math.abs(daysLeft)} days`;
                            daysElement.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800';
                        }
                    }
                }
            }
            
            // Initialize days left calculation
            updateDaysLeft();
        });
    </script>
</x-app-layout>