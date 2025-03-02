<header class="fixed top-0 left-0 w-full bg-cyan-700 shadow-md flex items-center pl-64 pr-6 py-3 z-40">

    <div class="flex items-center justify-between w-full">
        <button class="text-white text-lg">
            <i class="bi bi-list"></i>
        </button>

        <nav class="ml-auto">
            <ul class="flex items-center space-x-4">
                <li class="relative">
                    <button class="flex items-center space-x-2 focus:outline-none" id="profileMenuButton">
                        <img src="{{ asset('img/hero.jpg') }}" alt="Profile" class="w-8 h-8 rounded-full">
                        <span class="hidden md:block text-white">FINANCE ADMIN</span>
                        <i class="bi bi-chevron-down text-white"></i>
                    </button>

                    <ul id="profileMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden">
                        <li class="p-2 border-b text-center">
                            <h6 class="font-semibold">Finance Admin</h6>
                            <span class="text-sm text-gray-500">Accountant</span>
                        </li>
                        <li>
                            <a href="users-profile.html" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <i class="bi bi-person mr-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a href="users-profile.html" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <i class="bi bi-gear mr-2"></i> Account Settings
                            </a>
                        </li>
                        <li>
                            <a href="pages-faq.html" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <i class="bi bi-question-circle mr-2"></i> Need Help?
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center px-4 py-2 hover:bg-gray-100 text-red-500 w-full text-left">
                                    <i class="bi bi-box-arrow-right mr-2"></i> Sign Out
                                </button>
                            </form>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    document.getElementById('profileMenuButton').addEventListener('click', function() {
        document.getElementById('profileMenu').classList.toggle('hidden');
    });
</script>
