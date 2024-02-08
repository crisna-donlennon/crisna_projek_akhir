@extends('dashboard.main')

@section('content')
<div class="bg-white flex absolute left-80 top-10 p-2 pt-6 w-60 rounded-3xl">
    <p class="text-lg flex w-full justify-center">
        TYPE
    </p>
</div>

<div class="flex justify-between">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[1300px] mr-3 border-[2px]">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 shadow-lg border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-4 py-2 w-[80%]">
                        Tipe
                    </th>
                    <th scope="col" class="py-2 flex justify-center">
                        Hapus Tipe
                    </th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($types as $type)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-4 py-2 break-all bg-gray-100 uppercase">
                        {{ $type->nama_type }}
                    </td>
                    <td class="px-4 py-2 justify-center align-middle flex bg-gray-100">
                        <button onclick="showDeleteConfirmation({{ $type->id }})"
                            class="flex text-center items-center justify-center align-middle w-[20px] h-[20px] bg-red-600 rounded-md transition-all duration-300 active:scale-95 text-white hover:brightness-125 ">
                            <svg class="flex w-4 h-4 text-white opacity-90 justify-end items-center align-middle text-center"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-full sm:rounded-lg h-40 border-[2px]">
        <form class="m-5" action="/dashboard/type" method="POST">
            @csrf
            @method('post')
            <label for="nama_type" class="block mb-1 text-sm font-bold text-gray-900 uppercase dark:bg-gray-700 dark:text-gray-400 border-gray-300">
                Tambah Tipe: 
            </label>
            <input type="text" name="nama_type" id="nama_type" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-3">
                Tambah
            </button>
        </form>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="delete-confirmation-modal" class="fixed inset-0 z-50 hidden justify-center items-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-6 rounded-md w-96">
        <p class="text-xl font-bold mb-4">
            Konfirmasi Hapus Tipe
        </p>
        <p class="mb-4">
            Hapus tipe ini akan menghapus semua produk terkait. Apakah Anda yakin?
        </p>
        <form id="delete-type-form" class="flex justify-end">
            @csrf
            @method('delete')
            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-4 py-2 mr-2">
                Ya
            </button>
            <button type="button" onclick="hideDeleteConfirmation()" class="bg-gray-300 text-gray-700 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2">
                Tidak
            </button>
        </form>
    </div>
</div>

<script>
    function showDeleteConfirmation(typeId) {
        var modal = document.getElementById('delete-confirmation-modal');
        var form = document.getElementById('delete-type-form');
        form.action = '/dashboard/type/' + typeId;
        form.method = 'POST'; // Change the method to POST
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        modal.classList.remove('hidden');
    }

    function hideDeleteConfirmation() {
        var modal = document.getElementById('delete-confirmation-modal');
        modal.classList.add('hidden');
    }
</script>


@endsection
