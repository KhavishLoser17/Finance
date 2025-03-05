<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Finance System')</title>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    @vite('resources/css/app.css')


</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <div id="app">
        <!-- Navbar (Keeps it full width, does not overlap sidebar) -->


        <div class="flex">
            <!-- Sidebar -->


            <!-- Main Content (push right by sidebar width) -->
            <main class="flex-1 p-50 overflow-y-auto pt-16">
                @yield('content')
            </main>
        </div>

        <!-- Footer -->

    </div>
    <footer class="w-full bg-white shadow mt-auto">
        @include('layouts.footer')
    </footer>
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
