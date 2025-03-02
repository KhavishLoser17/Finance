@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

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
