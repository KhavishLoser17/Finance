@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Receivable Financial Report</h1>
        <a href="" class="text-blue-500">Dashboard/Financial Report</a>
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
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border-b">Sender Name</th>
                        <th class="p-3 border-b">Sender ID</th>
                        <th class="p-3 border-b">Amount</th>
                        <th class="p-3 border-b">Payment Date</th>
                        <th class="p-3 border-b">Due Date</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Action</th>
                        <th class="p-3 border-b">Send</th>
                    </tr>
                </thead>
                <tbody>
                    @if($receivables->isEmpty())
                        <tr>
                            <td colspan="8" class="p-3 border-b text-center">No receivable records found.</td>
                        </tr>
                    @else
                        @foreach($receivables as $receivable)
                            <tr>
                                <td class="p-3 border-b">{{ $receivable->sender_name }}</td>
                                <td class="p-3 border-b">{{ $receivable->sender_id }}</td>
                                <td class="p-3 border-b">₱{{ number_format($receivable->amount, 2) }}</td>
                                <td class="p-3 border-b"></td>
                                <td class="p-3 border-b">{{ $receivable->due_date }}</td>
                                <td class="p-3 border-b text-yellow-500">{{ $receivable->status }}</td>
                                <td class="p-3 border-b">
                                    <form action="{{ route('receivables.approve', $receivable->id) }}" method="POST" class="inline" onsubmit="return showSuccessAlert(event)">
                                        @csrf
                                        <button type="submit" class="text-green-500 cursor-pointer">Approve</button>
                                    </form>

                                     |
                                     <a href="#" class="text-red-500 cursor-pointer" onclick="showRejectAlert()">Reject</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </main>
</div>
<script>
    function showSuccessAlert(event) {
        event.preventDefault();
        Swal.fire({
            title: "Success!",
            text: "Transaction has been approved successfully.",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }

    function showRejectAlert() {
        Swal.fire({
            title: "Rejected!",
            text: "Transaction has been rejected.",
            icon: "error",
            confirmButtonText: "OK"
        });
    }
</script>
@endsection
