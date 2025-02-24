@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <aside class="fixed left-0 h-screen w-64 bg-blue-300 text-white pt-16 p-4 space-y-4 overflow-y-auto">
        <div class="flex items-center space-x-2 p-2">
            <span class="text-lg font-semibold">Finance System</span>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                <span>🏠 Dashboard</span>
            </a>
            <a href="{{ route('ledger') }}" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('ledger') ? 'bg-gray-700' : '' }}">
                <span>📖 General Ledger</span>
            </a>
            <hr class="border-gray-600 my-2">

            <!-- Disbursement Section -->
            <div>
                <button class="dropdown-button flex items-center justify-between w-full p-2 rounded-md hover:bg-gray-700 transition">
                    <span>💰 Disbursement</span>
                    <i class="lucide-chevron-down"></i>
                </button>
                <div class="pl-6 mt-1 space-y-2 hidden">
                    <a href="{{ route('payment') }}" class="block p-2 rounded-md hover:bg-gray-700 transition">
                        📅 Payment Scheduling
                    </a>
                </div>
            </div>

            <!-- Collection Section -->
            <div>
                <button class="dropdown-button flex items-center justify-between w-full p-2 rounded-md hover:bg-gray-700 transition">
                    <span>💳 Collection</span>
                    <i class="lucide-chevron-down"></i>
                </button>
                <div class="pl-6 mt-1 space-y-2 hidden">
                    <a href="{{ route('collected') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('receivables.aging') ? 'bg-gray-700' : '' }}">
                        📊 Collected Funds
                    </a>
                </div>
            </div>

            <!-- Budget Management Section -->
            <div>
                <button class="dropdown-button flex items-center justify-between w-full p-2 rounded-md hover:bg-gray-700 transition">
                    <span>💼 Budget Management</span>
                    <i class="lucide-chevron-down"></i>
                </button>
                <div class="pl-6 mt-1 space-y-2 hidden">
                    <a href="{{ route('reimburse') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('budget.forecast') ? 'bg-gray-700' : '' }}">
                        📊 Reimbursement Request
                    </a>
                    <a href="{{ route('audit') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('audit.logs') ? 'bg-gray-700' : '' }}">
                        📝 Auditing & Transaction Logs
                    </a>
                </div>
            </div>

            <!-- Account Receivable Section -->
            <div>
                <button class="dropdown-button flex items-center justify-between w-full p-2 rounded-md hover:bg-gray-700 transition">
                    <span>💵 Account Receivable</span>
                    <i class="lucide-chevron-down"></i>
                </button>
                <div class="pl-6 mt-1 space-y-2 hidden">
                    <a href="{{ route('receivables') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('receivables.aging') ? 'bg-gray-700' : '' }}">
                        📊 Receivable Financial Report
                    </a>
                </div>
            </div>

            <!-- Account Payable Section -->
            <div>
                <button class="dropdown-button flex items-center justify-between w-full p-2 rounded-md hover:bg-gray-700 transition">
                    <span>💸 Account Payable</span>
                    <i class="lucide-chevron-down"></i>
                </button>
                <div class="pl-6 mt-1 space-y-2 hidden">
                    <a href="{{ route('compliance') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('vendor.management') ? 'bg-gray-700' : '' }}">
                        📅 Compliance
                    </a>
                    <a href="{{ route('tax') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('payment.discount') ? 'bg-gray-700' : '' }}">
                        💲 Tax and Insurance
                    </a>
                </div>
            </div>
        </nav>


    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Payment Scheduling</h1>
            <a href="" class="text-blue-500">Disbursement/Payment Scheduling</a>
            <hr class="border-gray-600 my-2">
            <div class="flex justify-between items-center my-4">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="border border-blue-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    + Add
                </button>
            </div>
        <br>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full border border-black border-collapse text-left">
                <thead>
                    <tr class="bg-gray-400">
                        <th class="border border-black px-4 py-2">Transaction ID</th>
                        <th class="border border-black px-4 py-2">Amount</th>
                        <th class="border border-black px-4 py-2">Description</th>
                        <th class="border border-black px-4 py-2">Request Date</th>
                        <th class="border border-black px-4 py-2">Payment Method</th>
                        <th class="border border-black px-4 py-2">Released Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-200">
                        <td class="p-3 border-b">B2</td>
                        <td class="p-3 border-b">500</td>
                        <td class="p-3 border-b">Reimburse</td>
                        <td class="p-3 border-b">02/23/25</td>
                        <td class="p-3 border-b">Cash</td>
                        <td class="p-3 border-b">03/02/25</td>
                    </tr>
                    <tr class="bg-gray-200">

                    </tr>
                    <tr class="bg-gray-200">

                    </tr>
                </tbody>
            </table>
        </div>

    </main>
</div>
@endsection
