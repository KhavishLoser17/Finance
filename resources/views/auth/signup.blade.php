@extends('layouts.auth')

<main>
    <div class="h-screen flex flex-col md:flex-row relative">
        <!-- Right Side Background -->
        <div class="lg:w-3/5 lg:block hidden relative">
            <div class="absolute inset-0 bg-cover bg-center rounded-r-3xl" style="background-image: url('{{ asset('img/background.png') }}');"></div>
        </div>

        <!-- Left Side Form -->
        <div class="flex flex-col justify-center items-center py-6 px-4 lg:w-2/5 w-full min-h-screen bg-white relative z-10">
            <p class="font-extrabold lg:text-4xl text-2xl text-center text-[#00446b]">Bus Transportation Management System</p>
            <p class="font-semibold lg:text-2xl text-lg text-center mt-2 text-[#00446b]">Finance</p>

            <form action="{{ route('auth.register') }}" method="POST" class="xl:w-4/6 lg:w-5/6 sm:w-2/3 w-full py-8 rounded-3xl shadow-xl mt-6 flex flex-col items-center border bg-white">
                @csrf
                <p class="text-center mb-4 text-2xl font-bold text-[#00446b]">Create an Account</p>
                <hr class="border w-4/5 border-[#00446b]">

                <div class="mt-6 w-4/5 space-y-4">
                    <input name="first_name" value="{{ old('first_name') }}" class="w-full bg-gray-100 rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-[#00446b] focus:border-[#00446b]" type="text" placeholder="First Name" required>

                    <input name="last_name" value="{{ old('last_name') }}" class="w-full bg-gray-100 rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-[#00446b] focus:border-[#00446b]" type="text" placeholder="Last Name" required>

                    <input name="email" value="{{ old('email') }}" class="w-full bg-gray-100 rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-[#00446b] focus:border-[#00446b]" type="email" placeholder="Email" required>

                    <input name="contact_number" value="{{ old('contact_number') }}" class="w-full bg-gray-100 rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-[#00446b] focus:border-[#00446b]" type="number" placeholder="Contact Number" required>

                    <input name="password" class="w-full bg-gray-100 rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-[#00446b] focus:border-[#00446b]" type="password" placeholder="Password" required>

                    <input name="password_confirmation" class="w-full bg-gray-100 rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-[#00446b] focus:border-[#00446b]" type="password" placeholder="Confirm Password" required>
                </div>

                <div class="rounded-lg text-sm text-gray-600 w-4/5 mt-6">
                    <p>
                        People who use our service may have uploaded your contact information.
                        <a href="" class="text-blue-500 hover:underline">Learn more</a>.
                    </p>
                </div>

                <div class="rounded-lg text-sm text-gray-600 mt-2">
                    <p>
                        By clicking Sign Up, you agree to our
                        <a href="" class="text-blue-500 hover:underline">Terms</a>,
                        <a href="" class="text-blue-500 hover:underline">Privacy Policy</a>, and
                        <a href="" class="text-blue-500 hover:underline">Cookies Policy</a>.
                        You may receive SMS notifications and can opt out any time.
                    </p>
                </div>

                <div class="flex items-center mt-6 w-4/5">
                    <button class="w-full font-semibold p-3 rounded-lg shadow-md bg-[#00446b] hover:bg-[#003354] text-white transition duration-300" type="submit">
                        Sign Up
                    </button>
                </div>

                <div class="mt-4">
                    <p class="text-gray-600 text-sm">Already have an account?
                        <a href="{{ route('auth.signin') }}" class="text-blue-500 hover:text-blue-600 hover:underline font-medium">Log in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>

@extends('layouts.footer')
