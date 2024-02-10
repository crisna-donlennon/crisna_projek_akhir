@extends('layouts.base')

@section('container')

{{-- MAIN PAGE --}}
    <main class="bg-slate-300 container mx-auto min-w-full pb-5 pt-10 px-10">
        <div class="bg-slate-300 p-8 rounded w-96 mx-auto pb-20">
            <p class="text-3xl font-bold mb-8 text-center">Admin Registration</p>
            <form action="/adminregistration" method="post">
                @csrf
                <div class="mb-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Username (nama akun anda):</label>
                    <input type="text" id="name" name="name" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>

                <div class="mb-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Konfirmasi Password:</label>
                    <input type="password" id="password" name="password_confirmation" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>

                <div class="mb-2">
                    <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                    <input type="text" id="nomor_hp" name="nomor_hp" pattern="[0-9]{12,13}" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-yellow-300 text-black p-2 mt-2 rounded-md hover:bg-yellow-400">
                        Register
                    </button>

                    <div class="mb-2">
                        <label for="roles" class="block text-sm font-medium text-gray-700">Daftar sebagai:</label>
                        <select name="roles" id="roles" class="text-sm p-1">
                            <option value="pengguna">Pengguna</option>
                            <option value="admin">Admin</option>
                            <option value="pemilik">Pemilik</option>
                        </select>
                    </div>
                </div>
                <p class="text-left mt-4">Sudah terdaftar?
                    <a href="/login" class="text-blue-600 hover:text-blue-700 duration-300">Login akun disini</a>
                </p>
            </form>
        </div>
    </main>

    {{-- FOOTER --}}
    <x-footer />
@endsection
