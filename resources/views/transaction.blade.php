@extends('layouts.app')
@section('content')
<div class="flex">
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Transaction Logs</h1>
        <a href="" class="text-blue-500">Disbursement/Transaction Logs</a>
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

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
            <h1>All Transactions</h1>
            <table class="w-full text-left border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-4 border-b">Type</th>
                        <th class="p-4 border-b">Department</th>
                        <th class="p-4 border-b">Transaction ID</th>
                        <th class="p-4 border-b">Description</th>
                        <th class="p-4 border-b">Request By</th>
                        <th class="p-4 border-b">Request Date</th>
                        <th class="p-4 border-b">Evidence</th>
                        <th class="p-4 border-b">Amount</th>
                        <th class="p-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 border-b">{{ $transaction['type'] }}</td>
                            <td class="p-4 border-b">{{ $transaction['employee_name'] }}</td>
                            <td class="p-4 border-b">{{ $transaction['transaction_id'] }}</td>
                            <td class="p-4 border-b">{{ $transaction['description'] }}</td>
                            <td class="p-4 border-b">{{ $transaction['requested_by'] }}</td>
                            <td class="p-4 border-b">{{ $transaction['request_date'] }}</td>
                            <td class="p-4 border-b">
                                <a href="{{ asset($transaction['evidence']) }}" target="_blank">
                                    <img src="{{ asset($transaction['evidence']) }}" alt="Receipt" class="h-10 w-10 object-cover">
                                </a>
                            </td>
                            <td class="p-4 border-b">${{ number_format($transaction['amount'], 2) }}</td>
                            <td class="p-4 border-b">
                                <span class="px-3 py-1 text-sm font-semibold text-white
                                    {{ $transaction['status'] == 'Rejected' ? 'bg-red-500' : ($transaction['status'] == 'Pending' ? 'bg-yellow-500' : 'bg-green-500') }}
                                    rounded-full">
                                    {{ $transaction['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-4 border-b text-center">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</div>
@endsection
