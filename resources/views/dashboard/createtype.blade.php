@extends('dashboard.main')

@section('header')
<div class="">
    <p class="text-lg flex w-fit font-semibold">
        TYPES
    </p>
</div>
@endsection


@section('content')
<div class="relative overflow-x-auto w-full">
    <div class="flex justify-between w-full">
        <table id="type-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-4 py-2 w-full">
                        Tipe
                    </th>
                    <th scope="col" class="py-2 flex justify-center w-full">
                        Hapus Tipe
                    </th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($types as $type)
                <tr class="odd:bg-slate-50 odd:dark:bg-gray-900 even:bg-slate-100 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-4 py-2 break-all uppercase">
                        {{ $type->nama_type }}
                    </td>
                    <td class="px-4 py-2 justify-center flex items-center">
                        <button onclick="showDeleteConfirmation({{ $type->id }})" class="w-fit px-3 h-[30px] flex cursor-pointer items-center font-medium hover:brightness-95 uppercase rounded-md hover:text-red-600 ">
                            HAPUS TIPE
                        </button>
                    </td>



                    {{-- Delete Confirmation Modal --}}
                    <div id="delete-confirmation-modal" class="hidden bg-[rgba(0,0,0,0.5)] min-h-screen overflow-y-auto bg-overflow-x-hidden fixed z-50 justify-center items-center w-full md:inset-0 py-10">
                        <div class="bg-white p-6 rounded-md w-96">
                            <p class="text-xl font-bold mb-4">
                                Konfirmasi Hapus Tipe
                            </p>
                            <p class="mb-4">
                                Hapus tipe ini akan menghapus semua produk terkait. Apakah Anda yakin?
                            </p>
                            <div class="flex justify-end gap-4">
                                <form id="delete-type-form" class="flex justify-end">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-gray-100 hover:text-red-600 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-fit px-3 py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                                        Ya
                                    </button>
                                    <button type="button" onclick="hideDeleteConfirmation()" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-fit px-3 py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                                        Tidak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="w-1/2 rounded-md h-40 border-2">
            <form class="m-5" action="/dashboard/type" method="POST">
                @csrf
                @method('post')
                <label for="nama_type" class="block mb-1 font-bold text-gray-900 dark:bg-gray-700 dark:text-gray-400 border-gray-300">
                    Tambah Tipe: 
                </label>
                <input type="text" name="nama_type" id="nama_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <div class="flex items-center justify-between mt-2">
                    <button type="submit" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-full py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                        Tambahkan Tipe
                    </button>
                </div>
            </form>
        </div>
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
        modal.style.display = 'flex';
    }

    function hideDeleteConfirmation() {
        var modal = document.getElementById('delete-confirmation-modal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }





    // Initialize DataTables
    $(document).ready( function () {
        $('#type-table').DataTable({
            "order": [[0, "asc"]], // Sort by the third column (Type) in ascending order
            "columnDefs": [
                { "orderable": false, "targets": [1] } // Disable sorting for other columns
            ]
        });
    });

</script>


@endsection
