@extends('layouts.auth')

<main>
    <div class="h-screen flex md:flex-row flex-col relative">
        <!-- Right Side Background -->
        <div class="lg:w-3/5 lg:block hidden relative">
            <div class="absolute top-0 left-0 w-full h-full bg-cover bg-no-repeat bg-center" style="background-image: url('{{ asset('img/background.png') }}');"></div>
        </div>

        <!-- Left Side Form -->
        <div class="flex flex-col justify-center items-center py-4 lg:w-2/5 w-full min-h-screen relative z-10 bg-white">
            <p class="font-bold lg:text-4xl text-2xl w-full text-center text-[#00446b]">Bus Transportation Management System</p>
            <p class="font-semibold lg:text-3xl text-xl text-center mt-4 text-[#00446b]">Finance</p>

            <form class="xl:w-4/6 lg:w-5/6 sm:w-2/3 w-full py-8 rounded-3xl shadow-lg mt-10 flex flex-col items-center border bg-white">
                <p class="text-center mb-4 text-2xl text-[#00446b]">Sign In</p>
                <hr class="border w-4/5 border-[#00446b]">

                <div class="mt-8 w-4/5">
                    <input class="mt-1 block w-full bg-transparent rounded-md border p-2 focus:outline-none focus:border-[#00446b]" type="email" placeholder="Email">
                </div>
                <div class="mt-4 w-4/5">
                    <input class="mt-1 block w-full bg-transparent rounded-md border p-2 focus:outline-none focus:border-[#00446b]" type="password" placeholder="Password">
                </div>

                <div class="w-4/5 flex justify-between mt-4 lg:mb-12 mb-8">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-sm text-[#00446b]">Remember me</span>
                    </label>
                    <a class="text-sm text-[#00446b] hover:text-gray-500" href="forgot.html">Forgot your password?</a>
                </div>
                <div class="form-check form-check-info text-left">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                      I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                </div>
                <div class="flex items-center mt-4 w-4/5">
                    <button class="w-full font-medium p-2 rounded-md border bg-[#00446b] hover:bg-[#003354] text-white" type="submit">
                        Log In
                    </button>
                </div>
                
                <!-- Divider with OR -->
                <div class="flex items-center w-4/5 my-4">
                    <hr class="w-full border-gray-300">
                    <span class="mx-2 text-gray-500">or</span>
                    <hr class="w-full border-gray-300">
                </div>
                
                <!-- Continue with Google Button -->
                <div class="flex items-center w-4/5">
                    <button class="w-full font-medium p-2 rounded-md border border-gray-300 bg-white hover:bg-gray-100 text-black flex items-center justify-center" type="button">
                        <img src="{{ asset('img/google.png') }}" alt="Google Icon" class="w-5 h-5 mr-2">
                        Continue with Google
                    </button>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Don't have an account? <a href="{{route('auth.signup')}}" class="text-blue-500 hover:text-blue-600 hover:underline font-light text-sm">Register</a></p>
                </div>   
            </form>
        </div>
    </div>
</main>
