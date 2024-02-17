@extends('layouts.base')

@section('container')
<div class="container mx-auto my-8">
    <div class="bg-white container mx-auto my-8 p-8 rounded-md shadow-md w-2/3 flex flex-col border-[1px]">    
        <h2 class="text-2xl font-semibold mb-6 uppercase">
            PROFIL ANDA:
        </h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            @method('patch')
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">
                    Nama Akun
                </label>
                <label for="name" class="block text-xs text-gray-600">
                    (isi form jika ingin mengganti nama akun)
                </label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="nomor_hp" class="block font-medium text-gray-700">
                    Nomor HP
                </label>
                <label for="nomor_hp" class="block text-xs text-gray-600">
                    (isi form jika ingin mengganti nomor HP, nomor harus terdiri dari 12-13 digit)
                </label>
                <input type="text" name="nomor_hp" id="nomor_hp" value="{{ Auth::user()->nomor_hp }}" class="mt-1 p-2 border rounded w-full">
            </div>
            
            <div class="mb-4 border-t-2 pt-2">
                <p class="block font-medium text-gray-700">
                    Alamat
                </p>
                <a href="/create-alamat" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-fit px-3 py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                    TAMBAH ALAMAT
                </a>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-full py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
