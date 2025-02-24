@extends('layouts.app')

<main class="min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Half - Background Image -->
        <div class="hidden lg:block relative">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('img/curved14.jpg') }}');">
                <span class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></span>
                <div class="relative z-10 flex items-center justify-center h-full px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold mb-4">Welcome!</h1>
                        <p class="text-white text-lg">Use these awesome forms to login or create a new account in your project for free.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Half - Form -->
        <div class="w-full flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 bg-gray-50">
            <div class="w-full max-w-md space-y-8">
                <!-- Mobile Header (visible on small screens) -->
                <div class="lg:hidden text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Welcome!</h1>
                    <p class="text-gray-600">Create your account and start your journey.</p>
                </div>

                <!-- Card -->
                <div class="rounded-xl bg-white p-8 shadow-xl ring-1 ring-gray-200">
                    <div class="text-center mb-6">
                        <h5 class="text-xl font-semibold">Forgot Password</h5>
                    

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <form method="POST" action="" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="sr-only">Email address</label>
                            <input id="email" name="email" type="email" required 
                                class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Email address">
                        </div>

                        <button type="submit" 
                            class="flex w-full justify-center rounded-lg bg-gradient-to-r from-gray-800 to-gray-900 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Submit
                        </button>

                        <p class="text-center text-sm text-gray-600">
                            
                            <a href="#" class="font-medium text-gray-900 hover:text-gray-700">Cancel</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@extends('layouts.footer')