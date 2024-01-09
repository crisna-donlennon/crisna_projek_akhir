@extends('dashboard.main')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 shadow-lg border-b border-gray-300">
            <tr>
                <th scope="col" class="px-4 py-2">
                    Nama
                </th>
                <th scope="col" class="px-4 py-2">
                    Email
                </th>
                <th scope="col" class="px-4 py-2">
                    Alamat
                </th>
                <th scope="col" class="px-4 py-2">
                    Nomor HP
                </th>
                <th scope="col" class="px-4 py-2">
                    Roles
                </th>
                <th scope="col" class="py-2 flex justify-center">
                    Hapus User
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $user )
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-100">
                    {{ $user->name }}
                </th>
                <td class="px-4 py-2 bg-gray-100">
                    {{ $user->email }}
                </td>
                <td class="px-4 py-2 bg-gray-100">
                    {{ $user->alamat }}
                </td>
                <td class="px-4 py-2 bg-gray-100">
                    {{ $user->nomor_hp }}
                </td>
                <td class="px-4 py-2 bg-gray-100">
                    {{ $user->roles }}
                </td>
                <td class="px-4 py-2 justify-center flex items-center bg-gray-100">
                    <form class="w-10 h-10 flex justify-center items-center" action="{{ '/dashboard/user/'.$user->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="flex text-center items-center justify-center align-middle w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125 ">
                            <svg class="flex w-5 h-5 text-white opacity-90 justify-end items-center align-middle text-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection