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
                    <a href="{{ route('receivables') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('receivables.aging') ? 'bg-gray-700' : '' }}">
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
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Add
            </button>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 border-b ">Sender Name</th>
                            <th class="p-3 border-b">Sender ID</th>
                            <th class="p-3 border-b">Amount</th>
                            <th class="p-3 border-b">Payment Date</th>
                            <th class="p-3 border-b">Due Date</th>
                            <th class="p-3 border-b relative group">
                                Interest
                                <span class="ml-1 cursor-pointer text-gray-400 group-hover:text-gray-600">
                                    ❓
                                    <span class="absolute left-0 mt-1 w-30 p-2 text-sm text-white bg-gray-800 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                        If the payment is late, a 12% weekly interest applies.
                                    </span>
                                </span>
                            </th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">View</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-100">

                        </tr>
                        <tr class="border-b hover:bg-gray-100">
                           
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
