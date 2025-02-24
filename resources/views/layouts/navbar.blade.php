<nav class="fixed w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo (Full Width) -->
            <div class="flex-1">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-800 block">
                    COMPANY LOGO
                </a>
            </div>

            <!-- Profile and Logout -->
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                    Profile
                </a>

                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-500 px-3 py-2 rounded-md text-sm font-medium">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
