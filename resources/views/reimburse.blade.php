@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Financial Request</h1>
        <a href="" class="text-blue-500">Dashboard/Financial Request</a>
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
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Add
            </button>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border-b">Employee Name</th>
                        <th class="p-3 border-b">Request Date</th>
                        <th class="p-3 border-b">Description</th>
                        <th class="p-3 border-b">Evidence</th>
                        <th class="p-3 border-b">Amount</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reimburseList as $reimbursement)
                        <tr>
                            <td class="p-3 border-b">{{ $reimbursement->employee_name }}</td>
                            <td class="p-3 border-b">{{ $reimbursement->request_date }}</td>
                            <td class="p-3 border-b">{{ $reimbursement->description }}</td>
                            <td class="p-3 border-b">
                                <a href="{{ asset($reimbursement->evidence) }}" target="_blank">
                                    <img src="{{ asset($reimbursement->evidence) }}" alt="Receipt" class="h-10 w-10 object-cover">
                                </a>
                            </td>
                            <td class="p-3 border-b">₱{{ number_format($reimbursement->amount, 2) }}</td>
                            <td class="p-4 border-b">
                                <span class="px-3 py-1 text-sm font-semibold text-white
                                    {{ $reimbursement->status == 'Rejected' ? 'bg-red-500' : ($reimbursement->status == 'Pending' ? 'bg-yellow-500' : 'bg-green-500') }}
                                    rounded-full">
                                    {{ $reimbursement->status }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">
                                @if($reimbursement->status === 'Pending')
                                    <form id="form-approve-{{ $reimbursement->id }}" action="{{ route('reimburse.approve', $reimbursement->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="text-green-500 cursor-pointer" onclick="updateStatus('approve', {{ $reimbursement->id }})">Approve</button>
                                    </form>
                                    |
                                    <form id="form-reject-{{ $reimbursement->id }}" action="{{ route('reimburse.reject', $reimbursement->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="text-red-500 cursor-pointer" onclick="updateStatus('reject', {{ $reimbursement->id }})">Reject</button>
                                    </form>
                                @else
                                    <span class="text-gray-400 cursor-not-allowed">Action not available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div id="addModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-semibold mb-4">Financial Request</h2>
                <form action="{{ route('reimburse.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700">Employee Name</label>
                        <input type="text" name="employee_name" class="w-full border-gray-300 rounded-lg p-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700">Request Date</label>
                        <input type="date" name="request_date" class="w-full border-gray-300 rounded-lg p-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium">Transaction ID</label>
                        <input type="text" name="transaction_id" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium">Description</label>
                        <input type="text" name="description" class="w-full border rounded px-3 py-2" required placeholder="Reimbursement for ... ">
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700">Evidence</label>
                        <input type="file" name="evidence" class="w-full border-gray-300 rounded-lg p-2">
                    </div>
                    <div class="relative">
                        <label class="block mb-2">Amount</label>
                        <div class="flex items-center border rounded mb-3">
                            <span class="px-3 bg-gray-200 border-r">₱</span>
                            <input type="number" name="amount" class="w-full p-2 border-none" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium">Debit or Credit</label>
                        <select name="transaction_type" class="w-full border rounded px-3 py-2">
                            <option value="Debit">Debit</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg p-2">
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</div>
<script>
    function openModal() {
        document.getElementById("addModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("addModal").classList.add("hidden");
    }
</script>

<script>
    function updateStatus(action, id) {
        let statusText = action === "approve" ? "approved" : "rejected";
        let confirmText = action === "approve" ? "Yes, Approve" : "Yes, Reject";
        let confirmColor = action === "approve" ? "#10B981" : "#EF4444";
        let formId = `form-${action}-${id}`;

        Swal.fire({
            title: "Are you sure?",
            text: `Once confirmed, the status will be updated to ${statusText}.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: "#6B7280",
            confirmButtonText: confirmText
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Success!",
                    text: `Status has been changed to ${statusText}.`,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    document.getElementById(formId).submit();
                });
            }
        });
    }
</script>
@endsection
