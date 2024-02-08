@extends('layouts.base')

@section('container')
<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto bg-white p-8 border rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Account Settings</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-600">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label for="nomor_hp" class="block text-sm font-medium text-gray-600">Nomor HP</label>
                <input type="text" name="nomor_hp" id="nomor_hp" value="{{ Auth::user()->nomor_hp }}" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">New Password</label>
                <input type="password" name="password" id="password" class="mt-1 p-2 border rounded w-full">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 border rounded w-full">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<x-footer />

@endsection
