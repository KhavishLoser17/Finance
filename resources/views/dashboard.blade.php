
@extends('layouts.app')
@section('content')

<div class="flex">
    @include('layouts.sidenav')
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6 ">
        <h1 class="text-2xl font-bold">Accounting Dashboard</h1>
        <a href="" class="text-blue-500">Accounting Dashboard</a>
        <hr class="border-gray-600 my-2">
            <!-- Header -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 mb-6">

                <div class="bg-white p-4 shadow rounded-lg">
                    <p class="text-gray-600">Monthly Revenue</p>
                    <p class="text-2xl font-semibold text-green-500">₱{{ number_format($totalRevenue, 2) }}</p>
                </div>

                <div class="bg-white p-4 shadow rounded-lg">
                    <p class="text-gray-600">Monthly Expenses</p>
                    <p class="text-2xl font-semibold text-red-500">₱{{ number_format($totalExpenses, 2) }}</p>
                </div>
                <div class="bg-white p-4 shadow rounded-lg">
                    <p class="text-gray-600">Net Profit</p>
                    <p class="text-2xl font-semibold text-blue-500">
                        ₱{{ number_format($totalRevenue - $totalExpenses, 2) }}
                    </p>
                </div>

                <div class="bg-white p-4 shadow rounded-lg">
                    <p class="text-gray-600">Income Tax (20%)</p>
                    <p class="text-2xl font-semibold">
                        ₱{{ number_format($totalRevenue * 0.2, 2) }}
                    </p>
                </div>

                <div class="bg-white p-4 shadow rounded-lg">
                    <p class="text-gray-600">Total Profit</p>
                    <p class="text-2xl font-semibold text-blue-500">
                        ₱{{ number_format($totalRevenue - $totalExpenses * 0.2, 2) }}
                    </p>
                </div>
            </div>

            <div class="w-full max-w-8xl bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-4 text-center">Charts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="relative" style="height: 400px;">
                <h3 class="text-lg font-semibold text-gray-700 mb-2 text-center">Revenue Vs Expenses</h3>
                <canvas id="lineChart"></canvas>
            </div>
            <div class="relative" style="height: 400px;">
                <h3 class="text-lg font-semibold text-gray-700 mb-2 text-center">Expense Breakdown</h3>
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>


    </main>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let ctx = document.getElementById("lineChart").getContext("2d");

        let revenueData = @json(array_values($monthlyRevenue->toArray())); // Convert to array
        let expenseData = @json(array_values($monthlyExpenses->toArray()));
        let labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        let lineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Revenue",
                        data: revenueData,
                        borderColor: "green",
                        backgroundColor: "rgba(0, 128, 0, 0.2)",
                        borderWidth: 2,
                        fill: true
                    },
                    {
                        label: "Expenses",
                        data: expenseData,
                        borderColor: "red",
                        backgroundColor: "rgba(255, 0, 0, 0.2)",
                        borderWidth: 2,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });


    const donutCtx = document.getElementById('donutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Utilities', 'Insurance', 'Maintenance','Gas'],
            datasets: [{
                data: [30, 50, 20, 40],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56','#D3E671'],
                hoverBackgroundColor: ['#FF4365', '#1E90FF', '#FFD700','#D3E671']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection
