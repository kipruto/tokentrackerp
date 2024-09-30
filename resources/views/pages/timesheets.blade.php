@include('dashboard.components.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    @include('dashboard.components.sidebar')

    <!-- strat content -->
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="container mx-auto p-6">
            <!-- Top Row: Title and Create Timesheet Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Timesheets</h1>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"  onclick="document.getElementById('modal').classList.remove('hidden')">
                    + Create Timesheet
                </button>
            </div>

            <div class="flex justify-between items-center h-auto pr-5">
                <div class="flex items-center mb-4 space-x-4">
                    <div>
                        <span class="font-semibold">Sort by:</span>
                        <select id="sortBy" class="ml-2 border px-3 py-2 rounded-md" onchange="filterTimesheets()">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
                            <option value="employee_name" {{ request('sort_by') == 'employee_name' ? 'selected' : '' }}>Employee Name</option>
                            <option value="task_id" {{ request('sort_by') == 'task_id' ? 'selected' : '' }}>Task ID</option>
                        </select>
                    </div>

                    <div>
                        <span class="font-semibold">Approved:</span>
                        <select id="approvedFilter" class="ml-2 border px-3 py-2 rounded-md" onchange="filterTimesheets()">
                            <option value="all">All</option>
                            <option value="approved" {{ request('approved') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="notApproved" {{ request('approved') == 'notApproved' ? 'selected' : '' }}>Not Approved</option>
                        </select>
                    </div>

                    <div>
                        <span class="font-semibold">Status:</span>
                        <select id="statusFilter" class="ml-2 border px-3 py-2 rounded-md" onchange="filterTimesheets()">
                            <option value="all">All</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>
                </div>

                <div>
                    <div class="ml-auto flex items-center">
                        <span class="font-semibold">Page:</span>
                        <span class="ml-2">{{ $timesheets->currentPage() }} of {{ $timesheets->lastPage() }}</span>
                    </div>
                </div>
            </div>



            <!-- Timesheet Table -->
            <div class="overflow-x-scroll">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">
                                <input type="checkbox" id="selectAll" class="form-checkbox" onclick="toggleSelectAll(this)" />
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Approximated Hours</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submitted Hours</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Approved</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($timesheets as $timesheet)
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="checkbox" class="form-checkbox" />
                            </td>
                            <!-- Employee Name with Avatar -->
                            <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg mr-4">
                                    <!-- Display Initials -->
                                    @php
                                    $initials = collect(explode(' ', $timesheet->employee_name))
                                    ->map(fn($word) => strtoupper($word[0]))
                                    ->take(2)
                                    ->implode('');
                                    @endphp
                                    {{ $initials }}
                                </div>
                                <span>{{ $timesheet->employee_name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $timesheet->task_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $timesheet->project }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $timesheet->approximated_hours }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $timesheet->submitted_hours }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($timesheet->approved)
                                <span class="text-green-500">✔</span>
                                @else
                                <span class="text-red-500">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($timesheet->status == 'paid')
                                <button class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Paid</button>
                                @else
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Unpaid</button>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $timesheet->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $timesheet->created_at->format('H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('timesheets.destroy', $timesheet->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <!-- Delete Icon -->
                                        <i class="fad fa-trash text-red-500 text-xs mr-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $timesheets->links() }}
            </div>

        </div>

    </div>
    <!-- end content -->

</div>
<!-- end wrapper -->
<x-modal title="Add Time Entry" subtitle="Please enter correctly as it will be audited" action="{{ route('timesheets.store') }}" />
<script>
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>

@include('dashboard.components.footer')