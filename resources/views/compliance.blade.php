@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Compliance</h1>
        <a href="" class="text-blue-500">Dasboard/Tax and Compliance</a>
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
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Add
            </button>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border-b">Employee Name</th>
                        <th class="p-3 border-b">Transaction ID</th>
                        <th class="p-3 border-b">Description</th>
                        <th class="p-3 border-b">Request By</th>
                        <th class="p-3 border-b">Evidence</th>
                        <th class="p-3 border-b">Amount</th>
                        <th class="p-3 border-b">Releasing Date</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($compliance as $payable)
        <tr class="border-b hover:bg-gray-100">
            <td class="p-3 border-b">{{ $payable->employee_name }}</td>
            <td class="p-3 border-b">{{ $payable->transaction_id }}</td>
            <td class="p-3 border-b">{{ $payable->description }}</td>
            <td class="p-3 border-b">{{ $payable->request_by }}</td>
            <td class="p-3 border-b">
                <a href="{{ asset($payable->evidence) }}" target="_blank">
                    <img src="{{ asset($payable->evidence) }}" alt="Receipt" class="h-10 w-10 object-cover">
                </a>
            </td>
            <td class="p-3 border-b">₱{{ number_format($payable->amount, 2) }}</td>
            <td class="p-3 border-b text-blue-500">
                @if($payable->request_date)
                    {{ date('m/d/Y', strtotime($payable->request_date)) }}
                @else
                    Not Set
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
            </table>
        </div>
    </main>
</div>
@endsection
