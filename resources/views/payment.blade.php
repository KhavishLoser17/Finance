@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Payment Scheduling</h1>
            <a href="" class="text-blue-500">Disbursement/Payment Scheduling</a>
            <hr class="border-gray-600 my-2">
            <div class="flex justify-between items-center my-4">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="border border-blue-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
        <br>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Transaction ID</th>
                        <th class="border px-4 py-2">Amount</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Request Date</th>
                        <th class="border px-4 py-2">Payment Method</th>
                        <th class="border px-4 py-2">Released Date</th>
                        <th class="border px-4 py-2">Disburse</th>
                    </tr>
                </thead>
                <tbody>
                    @if($payments->isEmpty())
                        <tr>
                            <td colspan="7" class="border px-4 py-2 text-center">No approved payables found.</td>
                        </tr>
                    @else
                        @foreach($payments as $payable)
                        <tr class="border-b hover:bg-gray-100">
                                <td class="border px-4 py-2">{{ $payable->transaction_id }}</td>
                                <td class="border px-4 py-2">₱{{ number_format($payable->amount, 2) }}</td>
                                <td class="border px-4 py-2">{{ $payable->description }}</td>
                                <td class="border px-4 py-2">{{ date('m/d/Y', strtotime($payable->request_date)) }}</td>
                                <td class="border px-4 py-2">{{ $payable->payment_method ?? 'Not Specified' }}</td>
                                <td class="border px-4 py-2">{{ $payable->request_date ? date('m/d/Y', strtotime($payable->request_date)) : 'Not Released' }}</td>
                                @if(auth()->user()->user_type !== 'Accountant')
                                    <td class="border px-4 py-2">
                                        <form id="" action="" method="POST">
                                            @csrf
                                            <button type="button" class="text-blue-500 cursor-pointer" onclick="confirmSend()">Dispatch</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </main>
</div>

<script>
    function confirmSend() {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to send this?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3B82F6",
            cancelButtonColor: "#6B7280",
            confirmButtonText: "Yes, Send"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("send-form").submit();
            }
        });
    }
</script>
@endsection
