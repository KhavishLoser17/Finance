<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance System</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
    <style>
      html, body {
    height: 100%;
    display: flex;
    flex-direction: column;
}

#app {
    flex: 1;
    display: flex;
    flex-direction: column;
}
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidenav')

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto pt-16">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Dropdown Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('.dropdown-button');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const dropdownContent = button.nextElementSibling;
                    const arrow = button.querySelector('svg');

                    dropdownContent.classList.toggle('hidden');
                    arrow.classList.toggle('rotate-180');
                });
            });
        });
    </script>

</body>

</html>
