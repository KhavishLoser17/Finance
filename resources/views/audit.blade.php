@extends('layouts.app')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Audit</h1>
            <a href="" class="text-blue-500">Disbursement/Auditing and Transaction Logs</a>
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
                <div class="overflow-x-aut p-4 pb-6">
                    <button onclick="openPayableModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        + Add Payable
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4 pb-6">
                <h2 class="text-lg font-bold mb-2">Payable</h2>
                <table class="w-full text-left border-collapse mb-6">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 border-b">Department</th>
                            <th class="p-3 border-b">Transaction ID</th>
                            <th class="p-3 border-b">Description</th>
                            <th class="p-3 border-b">Request By</th>
                            <th class="p-3 border-b">Request Date</th>
                            <th class="p-3 border-b">Evidence</th>
                            <th class="p-3 border-b">Amount</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($payableList->isEmpty())
                            <tr>
                                <td colspan="9" class="p-3 border-b text-center">No payable records found.</td>
                            </tr>
                        @else
                            @foreach($payableList as $payable)
                                <tr>
                                    <td class="p-3 border-b">{{ $payable->employee_name }}</td>
                                    <td class="p-3 border-b">{{ $payable->transaction_id }}</td>
                                    <td class="p-3 border-b">{{ $payable->description }}</td>
                                    <td class="p-3 border-b">{{ $payable->request_by }}</td>
                                    <td class="p-3 border-b">{{ date('m/d/Y', strtotime($payable->request_date)) }}</td>
                                    <td class="p-3 border-b">
                                        <a href="{{ asset($payable->evidence) }}" target="_blank">
                                            <img src="{{ asset($payable->evidence) }}" alt="Receipt" class="h-10 w-10 object-cover">
                                        </a>
                                    </td>

                                    <td class="p-3 border-b">₱{{ number_format($payable->amount, 2) }}</td>
                                    <td class="p-3 border-b {{ $payable->status == 'Pending' ? 'text-yellow-500' : ($payable->status == 'Completed' ? 'text-green-500' : 'text-red-500') }}">
                                        {{ $payable->status }}
                                    </td>
                                    <td class="p-3 border-b">
                                        @if(auth()->user()->user_type !== 'Accountant')
                                            @if($payable->status == 'Pending')
                                                <form id="payableForm" action="{{ route('payable.approve', $payable->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="text-green-500 cursor-pointer payable-approve">Approve</button>
                                                </form>
                                                |
                                                <form id="rejectForm-{{ $payable->id }}" action="{{ route('payable.reject', $payable->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="button" class="text-red-500 cursor-pointer payable-reject" data-id="{{ $payable->id }}">Reject</button>
                                                </form>
                                            @else
                                                <span class="text-gray-400">{{ $payable->status }}</span>
                                            @endif
                                        @endif
                                    </td>


                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center my-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1 0 4.5 4.5a7.5 7.5 0 0 0 12.15 12.15z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Search..." class="border border-blue-500 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <button onclick="openReceivableModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 ml-2">
                    + Add Receivable
                </button>
            </div>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4 pb-6">
                <h2 class="text-lg font-bold mb-2 mt-8">Receivable</h2>
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 border-b">Department</th>
                            <th class="p-3 border-b">Department ID</th>
                            <th class="p-3 border-b">Transaction ID</th>
                            <th class="p-3 border-b">Description</th>
                            <th class="p-3 border-b">Amount</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($receivableList->isEmpty())
                            <tr>
                                <td colspan="9" class="p-3 border-b text-center">No receivable records found.</td>
                            </tr>
                        @else
                            @foreach($receivableList as $receivable)
                                <tr>
                                    <td class="p-3 border-b">{{ $receivable->sender_name }}</td>
                                    <td class="p-3 border-b">{{ $receivable->sender_id }}</td>
                                    <td class="p-3 border-b">{{ $receivable->transaction_id }}</td>
                                    <td class="p-3 border-b">{{ $receivable->description }}</td>

                                    <td class="p-3 border-b">₱{{ number_format($receivable->amount, 2) }}</td>
                                    <td class="p-3 border-b text-yellow-500">{{ $receivable->status }}</td>
                                    @if(auth()->user()->user_type !== 'Accountant')
                                        <td class="p-3 border-b">
                                            <a href="{{ route('receivables') }}" class="text-green-500 cursor-pointer">Confirm</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>

            {{-- MODAL FOR PAYABLE --}}
            <div id="payable-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-2/5">
                    <h2 class="text-lg font-bold mb-4">Add Account Payable</h2>
                    <form action="{{ route('payable.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                        @csrf
                        <div>
                            <label class="block mb-2">Department</label>
                            <input type="text" name="employee_name" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Transaction ID</label>
                            <input type="text" name="transaction_id" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Description</label>
                            <input type="text" name="description" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Request Date</label>
                            <input type="date" name="request_date" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Evidence (Image)</label>
                            <input type="file" name="evidence" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div class="relative">
                            <label class="block mb-2">Amount</label>
                            <div class="flex items-center border rounded mb-3">
                                <span class="px-3 bg-gray-200 border-r">₱</span>
                                <input type="number" name="amount" class="w-full p-2 border-none" required />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2">Payment Method</label>
                            <select name="payment_method" class="w-full p-2 border rounded mb-3" required>
                                <option>Bank Transfer</option>
                                <option>Cash</option>
                                <option>Cheque</option>
                                <option>E-Wallet</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2">Promissory Note</label>
                            <select name="request_by" id="payablePromissoryNote" class="w-full p-2 border rounded mb-3" required onchange="toggleNotesAmount('payable')">
                                <option value="None">None</option>
                                <option value="Notes Payable">Notes Payable</option>
                            </select>

                        </div>

                        <!-- Notes Amount Field (Initially Hidden) -->
                        <div id="payableNotesAmountContainer" class="hidden">
                            <label class="block mb-2">Notes Amount</label>
                            <input type="number" name="notes_amount" id="payableNotesAmount" class="w-full p-2 border rounded mb-3" placeholder="Enter Notes Amount" />
                        </div>
                        <div>
                            <label class="block mb-2">Transaction Type</label>
                            <select name="transaction_type" class="w-full p-2 border rounded mb-3" required>
                                <option>Credit</option>
                                <option>Debit</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2">Status</label>
                            <select name="status" class="w-full p-2 border rounded mb-3" required>
                                <option>Pending</option>
                            </select>
                        </div>
                        <div class="col-span-2 flex justify-end space-x-2">
                            <button type="button" onclick="closePayableModal()" class="bg-gray-400 text-white px-4 py-2 rounded-lg">Cancel</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 payable-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RECEIVABLE MODAL --}}
            <div id="receivable-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-2/5">
                    <h2 class="text-lg font-bold mb-4">Add Account Receivable</h2>
                    <form action="{{ route('receivable.store') }}" method="POST"  enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                        @csrf
                        <div>
                            <label class="block mb-2">Department</label>
                            <input type="text" name="sender_name" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Department ID</label>
                            <input type="text" name="sender_id" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Transaction ID</label>
                            <input type="text" name="transaction_id" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Description</label>
                            <input type="text" name="description" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Payment Method</label>
                            <select name="payment_method" class="w-full p-2 border rounded mb-3" required>
                                <option>Bank Transfer</option>
                                <option>Cash</option>
                                <option>Check</option>
                                <option>E-Wallet</option>
                            </select>
                        </div>
                        <div class="relative">
                            <label class="block mb-2">Amount</label>
                            <div class="flex items-center border rounded mb-3">
                                <span class="px-3 bg-gray-200 border-r">₱</span>
                                <input type="number" name="amount" class="w-full p-2 border-none" required />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2">Promissory Note</label>
                            <select name="request_by" id="receivablePromissoryNote" class="w-full p-2 border rounded mb-3" required onchange="toggleNotesAmount('receivable')">
                                <option value="None">None</option>
                                <option value="Notes Receivable">Notes Receivable</option>
                            </select>
                        </div>

                        <!-- Notes Amount Field (Initially Hidden) -->
                        <div id="receivableNotesAmountContainer" class="hidden">
                            <label class="block mb-2">Notes Amount</label>
                            <input type="number" name="notes_amount" id="receivableNotesAmount" class="w-full p-2 border rounded mb-3" placeholder="Enter Notes Amount" />
                        </div>
                        <div>
                            <label class="block mb-2">Payment Date</label>
                            <input type="date" name="payment_date" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Due Date</label>
                            <input type="date" name="due_date" class="w-full p-2 border rounded mb-3" required />
                        </div>
                        <div>
                            <label class="block mb-2">Transaction Type</label>
                            <select name="transaction_type" class="w-full p-2 border rounded mb-3" required>
                                <option>Credit</option>
                                <option>Debit</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2">Status</label>
                            <select name="status" class="w-full p-2 border rounded mb-3" required>
                                <option>Pending</option>
                            </select>
                        </div>
                        <div class="col-span-2 flex justify-end space-x-2">
                            <button type="button" onclick="closeReceivableModal()" class="bg-gray-400 text-white px-4 py-2 rounded-lg">Cancel</button>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 receivable-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
    </main>
</div>

<script>
    function openPayableModal() {
        document.getElementById("payable-modal").classList.remove("hidden");
    }
    function closePayableModal() {
        document.getElementById("payable-modal").classList.add("hidden");
    }
    function openReceivableModal() {
        document.getElementById("receivable-modal").classList.remove("hidden");
    }
    function closeReceivableModal() {
        document.getElementById("receivable-modal").classList.add("hidden");
    }
</script>

<script>
    function toggleNotesAmount(modalType) {
        let promissoryNote = document.getElementById(modalType + "PromissoryNote").value;
        let notesAmountContainer = document.getElementById(modalType + "NotesAmountContainer");
        let notesAmountInput = document.getElementById(modalType + "NotesAmount");

        let isNotesSelected = promissoryNote === "Notes Payable" || promissoryNote === "Notes Receivable";
        notesAmountContainer.classList.toggle("hidden", !isNotesSelected);
        notesAmountInput.required = isNotesSelected;
    }
</script>


@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // SweetAlert for Approval Success/Error
        @if(session('success'))
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        @endif

        // SweetAlert for Reject Confirmation
        document.querySelectorAll(".payable-reject").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once rejected, this cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, reject it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("rejectForm-" + id).submit();
                    }
                });
            });
        });
    });
</script>

@endif

@endsection
