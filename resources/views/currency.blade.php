@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Multi-Currency Settlement</h1>
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
                        <th class="p-3 border-b">#</th>
                        <th class="p-3 border-b">Date</th>
                        <th class="p-3 border-b">Payer</th>
                        <th class="p-3 border-b">Payee</th>

                        <th class="p-3 border-b">Amount</th>
                        <th class="p-3 border-b">Payment Method</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Actions</th>
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
