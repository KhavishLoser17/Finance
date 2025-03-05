@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Journal Ledger</h1>
        <a href="" class="text-blue-500">Journal</a>
        <hr class="border-gray-600 my-2">

        <!-- Search & Export -->
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

        <!-- Journal Header -->
        <div class="bg-white p-6 shadow rounded-lg">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold">Journal Entry</h1>
                <h2 class="text-gray-600">Bus Management System</h2>
            </div>

            <!-- Journal Details -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p><span class="font-medium">Sheet No.:</span> {{ $sheetNo }}</p>
                    <p><span class="font-medium">Account Number:</span> 1000</p>
                    <p><span class="font-medium">Account Name:</span> Cash</p>
                </div>
                <div class="text-right">
                    <p><span class="font-medium">Date: </span>{{ date('F Y', strtotime($month)) }}</p>
                    <p><span class="font-medium">Currency:</span> Peso</p>
                    <p><span class="font-medium">Page:</span> 1 of 1</p>
                </div>
            </div>
            <form method="GET" class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="categorize" class="mr-2" onchange="this.form.submit()" {{ request()->has('categorize') ? 'checked' : '' }}>
                    Group by Transaction Code
                </label>
            </form>

            <!-- Journal Table -->
            <table class="w-full text-left border-collapse shadow-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border font-semibold">Date</th>
                        <th class="p-3 border font-semibold">Explanation</th>
                        <th class="p-3 border font-semibold">Transaction ID</th>
                        <th class="p-3 border font-semibold text-right">Debit</th>
                        <th class="p-3 border font-semibold text-right">Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDebit = 0;
                        $totalCredit = 0;
                    @endphp

                    @foreach ($journalEntries as $entry)
                        <!-- Main Transaction Row -->
                        <tr>
                            <td class="p-3 border">{{ \Carbon\Carbon::parse($entry['date'])->format('F d, Y') }}</td>
                            <td class="p-3 border">{{ $entry['payment_method'] ?? '' }}</td>
                            <td class="p-3 border">{{ $entry['transaction_id'] }}</td>
                            <td class="p-3 border text-right">
                                @if ($entry['transaction_type'] == 'Debit')
                                    ₱{{ number_format($entry['amount'], 2) }}
                                    @php $totalDebit += $entry['amount']; @endphp
                                @endif
                            </td>
                            <td class="p-3 border text-right">
                                @if ($entry['transaction_type'] == 'Credit')
                                    ₱{{ number_format($entry['amount'], 2) }}
                                    @php $totalCredit += $entry['amount']; @endphp
                                @endif
                            </td>
                        </tr>

                        <!-- Description Row -->
                        @if (!empty($entry['description']))
                            <tr>
                                <td class="p-3 border"></td>
                                <td class="p-3 border">{{ $entry['description'] }}</td>
                                <td class="p-3 border"></td>
                                <td class="p-3 border text-right">
                                    @if ($entry['transaction_type'] == 'Credit')
                                        ₱{{ number_format($entry['amount'] - ($entry['notes_amount'] ?? 0), 2) }}
                                        @php $totalCredit += ($entry['amount'] - ($entry['notes_amount'] ?? 0)); @endphp
                                    @endif
                                </td>
                                <td class="p-3 border text-right">
                                    @if ($entry['transaction_type'] == 'Debit')
                                        ₱{{ number_format($entry['amount'] - ($entry['notes_amount'] ?? 0), 2) }}
                                        @php $totalDebit += ($entry['amount'] - ($entry['notes_amount'] ?? 0)); @endphp
                                    @endif
                                </td>
                            </tr>
                        @endif

                        <!-- Request By Row with Notes Amount -->
                        @if (!empty($entry['request_by']) && !empty($entry['notes_amount']))
                            <tr>
                                <td class="p-3 border"></td>
                                <td class="p-3 border">{{ $entry['request_by'] }}</td>
                                <td class="p-3 border"></td>
                                <td class="p-3 border text-right">
                                    @if ($entry['transaction_type'] == 'Credit')
                                        ₱{{ number_format($entry['notes_amount'], 2) }}
                                        @php $totalCredit += $entry['notes_amount']; @endphp
                                    @endif
                                </td>
                                <td class="p-3 border text-right">
                                    @if ($entry['transaction_type'] == 'Debit')
                                        ₱{{ number_format($entry['notes_amount'], 2) }}
                                        @php $totalDebit += $entry['notes_amount']; @endphp
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100">

                </tfoot>
            </table>

            <!-- Signature Section -->
            <div class="flex justify-between mt-6 text-sm">
                <div>
                    <p><span class="font-medium">Prepared By:</span> ________________</p>
                </div>
                <div>
                    <p><span class="font-medium">Approved By:</span> ________________</p>
                </div>
                <div>
                    <p><span class="font-medium">Date:</span> ________________</p>
                </div>
            </div>
        </div>

        <!-- Pagination (Optional) -->
        <div class="flex justify-between mt-6">
            <a href="{{ request()->fullUrlWithQuery(['month' => date('Y-m', strtotime($month . ' -1 month'))]) }}"
                class="px-4 py-2 bg-gray-300 rounded-lg">Previous</a>

             <a href="{{ request()->fullUrlWithQuery(['month' => date('Y-m', strtotime($month . ' +1 month'))]) }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg">Next</a>
        </div>
    </main>
</div>
@endsection
