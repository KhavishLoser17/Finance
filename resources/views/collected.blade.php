@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Collected Funds</h1>
        <a href="" class="text-blue-500">Dashboard/Collected Funds</a>
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
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-lg shadow-md text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 border-b">Department</th>
                            <th class="p-3 border-b">Department ID</th>
                            <th class="p-3 border-b">Transaction ID</th>
                            <th class="p-3 border-b">Amount</th>
                            <th class="p-3 border-b">Payment Date</th>
                            <th class="p-3 border-b">Due Date</th>
                            <th class="p-3 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($collected->isEmpty())
                            <tr>
                                <td colspan="8" class="p-3 border-b text-center">No collected receivables found.</td>
                            </tr>
                        @else
                            @foreach($collected as $receivable)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="p-3 border-b">{{ $receivable->sender_name }}</td>
                                    <td class="p-3 border-b">{{ $receivable->sender_id }}</td>
                                    <td class="p-3 border-b">{{ $receivable->transaction_id }}</td>
                                    <td class="p-3 border-b">{{ $receivable->amount }}</td>
                                    <td class="p-3 border-b">{{ $receivable->payment_date }}</td>
                                    <td class="p-3 border-b">{{ $receivable->due_date }}</td>

                                    <td class="p-3 border-b text-green-500">{{ $receivable->status }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
