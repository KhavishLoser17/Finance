@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('layouts.navbar')
    @include('layouts.sidenav')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold">Budget Allocation</h1>
        <a href="" class="text-blue-500">Dashboard/Budget Allocation</a>
        <hr class="border-gray-600 my-2">
        <div class="bg-white p-8 shadow-lg rounded-lg">
            <!-- Header -->
            <div class="relative mb-4">
                <!-- Title and Subtitle -->
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Allocated Funds</h1>
                    <div class="flex justify-center mt-8 space-x-4">
                        <!-- Previous Year -->
                        <a href="{{ route('allocation', ['year' => $year - 1]) }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                            &larr; Prev
                        </a>

                        <!-- Current Year Display -->
                        <span class="text-xl font-bold text-gray-800">{{ $year }}</span>

                        <!-- Next Year -->
                        <a href="{{ route('allocation', ['year' => $year + 1]) }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                           Next &rarr;
                        </a>
                    </div>
                </div>

                <!-- Add Button (Right-Aligned) -->
                <button onclick="openModal()" class="absolute top-0 right-0 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    + Add Budget
                </button>
            </div>
            <div class="mt-8 flex justify-center">
                <div class="bg-blue-100 text-blue-700 px-12 py-6 rounded-2xl text-3xl font-extrabold shadow-lg border border-blue-400">
                    ₱ {{ number_format($totalEquity, 2) }}
                </div>
            </div>

            <!-- Department Budgeting -->
            <h2 class="mt-12 text-3xl font-semibold text-gray-700 border-b pb-3 text-center">Department Budgeting</h2>


            <div class="mt-6 grid grid-cols-3 gap-6">
                <!-- HR -->
                <div class="p-8 bg-gray-50 border border-gray-400 rounded-xl shadow-md text-center">
                    <p class="font-bold text-gray-900 text-2xl">HR</p>
                    <p class="text-gray-700 text-xl mt-2">Balance: <span class="font-bold">₱ {{ number_format($hrBalance, 2) }}</span></p>
                </div>

                   <!-- CORE -->
                   <div class="p-8 bg-gray-50 border border-gray-400 rounded-xl shadow-md text-center">
                    <p class="font-bold text-gray-900 text-2xl">CORE</p>
                    <p class="text-gray-700 text-xl mt-2">Balance: <span class="font-bold">₱ {{ number_format($coreBalance, 2) }}</span></p>
                </div>


                <!-- Logistics -->
                <div class="p-8 bg-gray-50 border border-gray-400 rounded-xl shadow-md text-center">
                    <p class="font-bold text-gray-900 text-2xl">Logistics</p>
                    <p class="text-gray-700 text-xl mt-2">Balance: <span class="font-bold">₱ {{ number_format($logisticBalance)}}</span></p>
                </div>
            </div>
        </div>

        <div id="addBudgetModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
            <!-- Modal Content -->
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Add Budget</h2>
                <!-- Form -->
                <form method="POST" action="{{route('allocation.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="block font-semibold">Transaction ID</label>
                        <input type="text" name="transaction_id" class="w-full p-2 border rounded-lg" placeholder="Enter Transaction ID" required>
                    </div>

                    <div class="mb-3">
                        <label class="block font-semibold">Department</label>
                        <select name="department" class="w-full p-2 border rounded-lg" required>
                            <option value="HR">Human Resource</option>
                            <option value="CORE">CORE</option>
                            <option value="Logistics">Logistics</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block font-semibold">Description</label>
                        <input type="text" name="description" class="w-full p-2 border rounded-lg" placeholder="Enter Description" required>
                    </div>

                    <div class="relative">
                        <label class="block mb-2">Amount</label>
                        <div class="flex items-center border rounded mb-3">
                            <span class="px-3 bg-gray-200 border-r">₱</span>
                            <input type="number" name="amount" class="w-full p-2 border-none" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block font-semibold">Payment Method</label>
                        <select name="payment_method" class="w-full p-2 border rounded-lg" required>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="E-Wallet">E-Wallet</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block font-semibold">Date</label>
                        <input type="date" name="date" class="w-full p-2 border rounded-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="block font-semibold">Transaction Type</label>
                        <select name="transaction_type" class="w-full p-2 border rounded-lg" required>
                            <option value="Credit">Credit</option>
                            <option value="Debit">Debit</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </main>
</div>
<script>
    function openModal() {
        document.getElementById("addBudgetModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("addBudgetModal").classList.add("hidden");
    }
</script>

@endsection
