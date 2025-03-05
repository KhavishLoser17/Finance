@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">General Ledger</h1>
        <a href="" class="text-blue-500">General Ledger</a>
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
          
            <button onclick="openEquityModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                + ADD COMPANY EQUITY
            </button>
        </div>

        <div class="bg-white p-6 shadow rounded-lg">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold">GENERAL LEDGER</h1>
                <h2>Bus Management System</h2>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p><span class="font-medium">Sheet No.:</span> {{ $sheetNo }}</p>
                    <p><span class="font-medium">Account Number:</span> 1000</p>
                    <p><span class="font-medium">Account Name:</span> Cash</p>
                </div>
                <div class="text-right">
                    <p><span class="font-medium">Date: </span>{{ date('F Y', strtotime($month)) }}</p>
                    <p><span class="font-medium">Currency: </span>Peso</p>
                    <p><span class="font-medium">Page:</span> 1 of 1</p>
                </div>
            </div>
    <table class="w-full text-left border-collapse shadow-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border font-semibold">Date</th>
                <th class="p-3 border font-semibold">Transaction ID</th>
                <th class="p-3 border font-semibold">Description</th>
                <th class="p-3 border font-semibold text-right">Debit</th>
                <th class="p-3 border font-semibold text-right">Credit</th>
                <th class="p-3 border font-semibold text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $balance = 0;
                $totalDebit = 0;
                $totalCredit = 0;
            @endphp
            @foreach($ledgerEntries as $entry)
                @php
                    $debit = $entry->transaction_type === 'Debit' ? $entry->amount : 0;
                    $credit = $entry->transaction_type === 'Credit' ? $entry->amount : 0;
                    $balance += $debit - $credit;
                    $totalDebit += $debit;
                    $totalCredit += $credit;
                @endphp
                <tr class="hover:bg-gray-100">
                    <td class="p-3 border">{{ $entry->date }}</td>
                    <td class="p-3 border">{{ $entry->transaction_id }}</td>
                    <td class="p-3 border">{{ $entry->description }}</td>
                    <td class="p-3 border text-right">{{ $debit > 0 ? number_format($debit, 2) : '-' }}</td>
                    <td class="p-3 border text-right">{{ $credit > 0 ? number_format($credit, 2) : '-' }}</td>
                    <td class="p-3 border text-right font-medium">{{ number_format($balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-gray-100">
            <tr>
                <td colspan="3" class="p-3 border font-semibold text-right">Totals:</td>
                <td class="p-3 border text-right font-semibold">₱{{ number_format($totalDebit, 2) }}</td>
                <td class="p-3 border text-right font-semibold">₱{{ number_format($totalCredit, 2) }}</td>
                <td class="p-3 border text-right font-semibold">₱{{ number_format($balance, 2) }}</td>
            </tr>
        </tfoot>
    </table>

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
         <div class="flex justify-between mt-6">
            <a href="?month={{ date('Y-m', strtotime($month . ' -1 month')) }}" class="px-4 py-2 bg-gray-300 rounded-lg">Previous</a>

            <a href="?month={{ date('Y-m', strtotime($month . ' +1 month')) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Next</a>
        </div>

         {{-- MODAL FOR EQUITY --}}
         <div id="equityModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-bold mb-4">Add Company Equity</h2>

                <form action="{{route('ledger.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="block font-medium">Transaction ID</label>
                        <input type="text" name="transaction_id" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium">Description</label>
                        <input type="text" name="description" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium">Amount</label>
                        <input type="number" name="amount" class="w-full border rounded px-3 py-2" required>
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

                    <div class="mb-3">
                        <label class="block font-medium">Debit or Credit</label>
                        <select name="transaction_type" class="w-full border rounded px-3 py-2">
                            <option value="Debit">Debit</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium">Date</label>
                        <input type="date" name="date" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <input type="hidden" name="status" value="Approved">

                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeEquityModal()" class="bg-gray-400 text-white px-4 py-2 rounded-lg">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<script>
    function openEquityModal() {
        document.getElementById("equityModal").classList.remove("hidden");
    }

    function closeEquityModal() {
        document.getElementById("equityModal").classList.add("hidden");
    }
</script>
@endsection
