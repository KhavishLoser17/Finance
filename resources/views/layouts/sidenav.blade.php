<aside class="fixed left-0 h-screen w-64 bg-blue-300 text-white pt-16 p-4 space-y-4 overflow-y-auto">
    <div class="flex items-center space-x-2 p-2">
        <span class="text-lg font-semibold">Finance System</span>
    </div>
    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            <span>🏠 Dashboard</span>
        </a>
        <a href="{{ route('ledger') }}" 
           class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('ledger') ? 'bg-gray-700' : '' }}">
            <span>📖 General Ledger</span>
        </a>

        <hr class="border-gray-600 my-2">

    </nav>
</aside>