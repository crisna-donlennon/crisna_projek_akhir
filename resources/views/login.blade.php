@extends('layouts.base')

@section('container')
    

    {{-- MAIN PAGE --}}
    <main class="bg-slate-300 container mx-auto min-w-full pb-5 pt-10 px-10">
        <div class="bg-slate-300 p-8 rounded w-96 mx-auto pb-20">
            <p class="text-3xl font-bold mb-8 text-center">Login</p>
            <form action="/login" method="post">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>
    
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required
                        class="border-[1px] border-gray-400 mt-1 p-2 w-full hover:border-gray-500 focus:outline-none">
                </div>
                
                <button type="submit"
                class="bg-yellow-300 text-black p-2 mt-2 w-full hover:bg-yellow-400">
                Login
                </button>
    
                <p class="text-left mt-4">Belum mempunyai akun?
                    <a href="/registration" class="text-blue-600 hover:text-blue-700 duration-300">Daftar disini</a>
                </p>
        </form>
        </div>
    </main>

    {{-- FOOTER --}}
    <x-footer/>
@endsection