@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Tax and Insurance</h1>
        <a href="" class="text-blue-500">Dashboard/Tax and Compliance</a>
        <hr class="border-gray-600 my-2">
        <div class="flex justify-between items-center my-4">
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1 0 4.5 4.5a7.5 7.5 0 0 0 12.15 12.15z" />
                    </svg>
                </span>
                <input type="text" placeholder="Search..." class="border border-blue-500 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button onclick="toggleModal(true)" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Add Employee Salary
            </button>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border-b">Employee Name</th>
                        <th class="p-3 border-b">Salary</th>
                        <th class="p-3 border-b">Government Tax</th>
                        <th class="p-3 border-b">SSS</th>
                        <th class="p-3 border-b">Pag-Ibig</th>
                        <th class="p-3 border-b">Phil Health</th>
                        <th class="p-3 border-b">Net Salary</th>
                        <th class="p-3 border-b">Schedule Release Date</th>
                        <th class="p-3 border-b">Payment Method</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSalaries = 0;
                        $totalGovTax = 0;
                        $totalSSS = 0;
                        $totalPagibig = 0;
                        $totalPhilhealth = 0;
                        $totalNetSalary = 0;
                    @endphp

                    @if($taxes->isEmpty())
                        <tr>
                            <td colspan="10" class="p-3 border-b text-center">No tax records found.</td>
                        </tr>
                    @else
                        @foreach($taxes as $tax)
                            @php
                                $govTax = $tax->amount * 0.08;
                                $sss = $tax->amount * 0.03;
                                $pagibig = $tax->amount * 0.03;
                                $philhealth = $tax->amount * 0.08;

                                $totalDeductions = $govTax + $sss + $pagibig + $philhealth;
                                $totalSalary = $tax->amount - $totalDeductions;

                                $totalSalaries += $tax->amount;
                                $totalGovTax += $govTax;
                                $totalSSS += $sss;
                                $totalPagibig += $pagibig;
                                $totalPhilhealth += $philhealth;
                                $totalNetSalary += $totalSalary;
                            @endphp
                            <tr class="even:bg-gray-50 hover:bg-gray-100">
                                <td class="p-3 border-b">{{ $tax->employee_name }}</td>
                                <td class="p-3 border-b">₱{{ number_format($tax->amount, 2) }}</td>
                                <td class="p-3 border-b">₱{{ number_format($govTax, 2) }}</td>
                                <td class="p-3 border-b">₱{{ number_format($sss, 2) }}</td>
                                <td class="p-3 border-b">₱{{ number_format($pagibig, 2) }}</td>
                                <td class="p-3 border-b">₱{{ number_format($philhealth, 2) }}</td>
                                <td class="p-3 border-b font-semibold">{{ number_format($totalSalary, 2) }}</td>
                                <td class="p-3 border-b">{{ date('m/d/Y', strtotime($tax->schedule_release_date)) }}</td>
                                <td class="p-3 border-b">{{ $tax->payment_method }}</td>
                                <td class="p-4 border-b">
                                    <span class="px-3 py-1 text-sm font-semibold text-white
                                        {{ $tax['status'] == 'Rejected' ? 'bg-red-500' : ($tax['status'] == 'Pending' ? 'bg-yellow-500' : 'bg-green-500') }}
                                        rounded-full">
                                        {{ $tax['status'] }}
                                    </span>
                                </td>
                                @if(auth()->user()->user_type !== 'Accountant')
                                        <td class="p-3 border-b">
                                            @if ($tax->status === 'Pending')
                                                <form id="approve-form-{{ $tax->id }}" action="{{ route('tax.approve', $tax->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="button" class="text-green-500 cursor-pointer" onclick="confirmApproval({{ $tax->id }})">Approve</button>
                                                </form>
                                                |
                                                <form id="reject-form-{{ $tax->id }}" action="{{ route('tax.reject', $tax->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="button" class="text-red-500 cursor-pointer" onclick="confirmRejection({{ $tax->id }})">Reject</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">Action Not Available</span>
                                            @endif
                                        </td>
                                    @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot class="bg-gray-100 font-semibold">
                    <hr class="border-gray-600 my-2">
                    <tr>
                        <td class="p-3 border-t">Totals:</td>
                        <td class="p-3 border-t">₱{{ number_format($totalSalaries, 2) }}</td>
                        <td class="p-3 border-t">₱{{ number_format($totalGovTax, 2) }}</td>
                        <td class="p-3 border-t">₱{{ number_format($totalSSS, 2) }}</td>
                        <td class="p-3 border-t">₱{{ number_format($totalPagibig, 2) }}</td>
                        <td class="p-3 border-t">₱{{ number_format($totalPhilhealth, 2) }}</td>
                        <td class="p-3 border-t">₱{{ number_format($totalNetSalary, 2) }}</td>
                        <td colspan="3" class="p-3 border-t"></td>
                    </tr>
                </tfoot>
            </table>

        </div>

        <div id="salaryModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-[600px]">
                <h2 class="text-xl font-semibold mb-4">Add Employee Salary</h2>

                <form action="{{route('tax.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Employee Name</label>
                            <input type="text" name="employee_name" class="w-full border-gray-300 rounded-lg p-2" placeholder="Employee Name" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Transaction ID</label>
                            <input type="text" name="transaction_id" class="w-full border-gray-300 rounded-lg p-2" placeholder="Transaction ID" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="description" class="w-full border-gray-300 rounded-lg p-2" placeholder="Description" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Salary</label>
                            <input type="number" name="amount" class="w-full border-gray-300 rounded-lg p-2" placeholder="Input Salary" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <select name="payment_method" class="w-full border-gray-300 rounded-lg p-2" required>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Check">Check</option>
                                <option value="Cash">Cash</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Schedule Release Date</label>
                            <input type="date" name="schedule_release_date" class="w-full border-gray-300 rounded-lg p-2" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Transaction Type</label>
                            <select name="transaction_type" class="w-full border-gray-300 rounded-lg p-2" required>
                                <option>Credit</option>
                                <option>Debit</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="w-full border-gray-300 rounded-lg p-2" required>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="toggleModal(false)" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</div>

<script>
    function toggleModal(show) {
        const modal = document.getElementById('salaryModal');
        modal.classList.toggle('hidden', !show);
    }
</script>
<script>
    function confirmApproval(id) {
        Swal.fire({
            title: "Approve Transaction?",
            text: "Are you sure you want to approve this transaction?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#10B981",
            cancelButtonColor: "#6B7280",
            confirmButtonText: "Yes, Approve"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("approve-form-" + id).submit();
            }
        });
    }

    function confirmRejection(id) {
        Swal.fire({
            title: "Reject Transaction?",
            text: "Are you sure you want to reject this transaction?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF4444",
            cancelButtonColor: "#6B7280",
            confirmButtonText: "Yes, Reject"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("reject-form-" + id).submit();
            }
        });
    }
</script>

@endsection
