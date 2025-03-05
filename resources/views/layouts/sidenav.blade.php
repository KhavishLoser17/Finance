<aside class="fixed left-0 top-0 h-screen w-64 bg-indigo-950 text-white p-4 space-y-4 overflow-y-auto z-[60]">


    <div class="flex items-center justify-center space-x-2 p-2">
        <img src="{{ asset('img/logo1.png') }}" alt="Logo" class="w-50 h-50 rounded-full"> <!-- Add your logo here -->

    </div>

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
        <div>
            <a href="{{ route('journal') }}"
               class="flex items-center gap-2 w-full p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('journal') ? 'bg-gray-700' : '' }}">
                <i class="fa-solid fa-book"></i>
                <span>Journal</span>
            </a>
        </div>



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
            </button>
            <div class="pl-6 mt-1 space-y-2 hidden">
                <a href="{{ route('allocation') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('budget.forecast') ? 'bg-gray-700' : '' }}">
                    <i class="fa-solid fa-landmark"></i>
                    <span>Budget Allocation</span>
                </a>
                <a href="{{ route('reimburse') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('budget.forecast') ? 'bg-gray-700' : '' }}">
                    📊 Financial Request
                </a>
                <a href="{{ route('audit') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('audit.logs') ? 'bg-gray-700' : '' }}">
                    📝 Audit
                </a>
                <a href="{{ route('transaction') }}" class="block p-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('audit.logs') ? 'bg-gray-700' : '' }}">
                    📖 Transaction Logs
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
