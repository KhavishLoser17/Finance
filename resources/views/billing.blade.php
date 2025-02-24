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
        <h1 class="text-2xl font-bold">Automated Billing</h1>
        <a href="" class="text-blue-500">Dasboard/Automated Billing</a>
        <hr class="border-gray-600 my-2">

        <div>
            <h2>📊 Main Content</h2>
            <p>This is your main dashboard content area.</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border-b">Description</th>
                        <th class="p-3 border-b">Aspect</th>
                        <th class="p-3 border-b">Time Frame</th>
                        <th class="p-3 border-b"></th>
                        <th class="p-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-50 hover:bg-gray-100">
                        <td class="p-3 border-b">1</td>
                        <td class="p-3 border-b">2025-02-20</td>
                        <td class="p-3 border-b">John Doe</td>
                        <td class="p-3 border-b">Jane Smith</td>

                        <td class="p-3 border-b">$1,500.00</td>
                        <td class="p-3 border-b">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">E-Wallet</span>
                        </td>
                        <td class="p-3 border-b">
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">Pending</span>
                        </td>
                        <td class="p-3 border-b">
                            <button class="text-blue-600 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="even:bg-gray-50 hover:bg-gray-100">
                        <td class="p-3 border-b">2</td>
                        <td class="p-3 border-b">2025-02-18</td>
                        <td class="p-3 border-b">Alice Brown</td>
                        <td class="p-3 border-b">Carlos Diaz</td>

                        <td class="p-3 border-b">€2,300.75</td>
                        <td class="p-3 border-b">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Bank Transfer</span>
                        </td>
                        <td class="p-3 border-b">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Completed</span>
                        </td>
                        <td class="p-3 border-b">
                            <button class="text-blue-600 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="even:bg-gray-50 hover:bg-gray-100">
                        <td class="p-3 border-b">3</td>
                        <td class="p-3 border-b">2025-02-15</td>
                        <td class="p-3 border-b">Mike Lee</td>
                        <td class="p-3 border-b">Emma Watson</td>

                        <td class="p-3 border-b">¥250,000</td>
                        <td class="p-3 border-b">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">Cash</span>
                        </td>
                        <td class="p-3 border-b">
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">Failed</span>
                        </td>
                        <td class="p-3 border-b">
                            <button class="text-blue-600 hover:underline">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
