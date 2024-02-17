@extends('layouts.base')

@section('container')

{{-- MAIN PAGE --}}
    <main class="container mx-auto min-w-full pb-5 pt-10 px-10">
        <div class="bg-white p-8 w-96 mx-auto pb-10 border-[1px] shadow-md rounded-md">
            <p class="text-3xl font-bold mb-8 text-center">
                Account Registration
            </p>
            <form action="/registration" method="post">
                @csrf
                <div class="mb-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                        Username (nama akun anda): 
                    </label>
                    <input type="text" id="name" name="name" required autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                </div>

                <div class="mb-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                        Email: 
                    </label>
                    <input type="email" id="email" name="email" required autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                        Password: 
                    </label>
                    <input type="password" id="password" name="password" required autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                        Konfirmasi Password: 
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                </div>

                <div class="mb-2">
                    <label for="nomor_hp" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                        Nomor Telepon: 
                    </label>
                    <input type="text" id="nomor_hp" name="nomor_hp" pattern="[0-9]{12,13}" required autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-yellow-300 w-full py-1 mt-10 hover:brightness-95 justify-center flex items-center text-lg font-bold rounded-md">
                        Register
                    </button>
                </div>

                <p class="text-left mt-4">
                    Sudah terdaftar?
                    <a href="/login" class="text-blue-600 hover:text-blue-700 duration-300">
                        Login akun disini
                    </a>
                </p>
            </form>
        </div>
    </main>
@endsection
