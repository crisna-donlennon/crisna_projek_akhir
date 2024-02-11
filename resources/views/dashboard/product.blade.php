@extends('dashboard.main')

@section('content')
    <div class="bg-white flex absolute left-80 top-10 p-2 pt-6 w-60 rounded-3xl">
        <p class="text-lg flex w-full justify-center">
            PRODUCT
        </p>
    </div>
    <a href="/dashboard/create-product">
        <button type="button" class="flex absolute right-20 top-[70px] p-2 mr-2 mt-1 hover:brightness-125">
            <svg class="w-7 h-7 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="ml-2 pt-[1px] text-gray-600">
                Tambahkan Produk
            </p>
        </button>
    </a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 shadow-lg border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-4 py-2">
                        Nama
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Type
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Stok
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Berat
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Harga
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Gambar
                    </th>
                    <th scope="col" class="py-2 flex justify-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-4 py-2 text-gray-900 bg-gray-100 font-bold break text-xs w-60" scope="row">
                            {{ $product->nama_product }}
                        </th>
                        <td class="px-4 py-2 bg-gray-100 break">
                            {{ $product->deskripsi }}
                        </td>
                        <td class="px-4 py-2 bg-gray-100 break uppercase">
                            {{ $product->type->nama_type }}
                        </td>
                        <td class="px-4 py-2 bg-gray-100">
                            {{ $product->stok }}
                        </td>
                        <td class="px-4 py-2 bg-gray-100">
                            {{ $product->berat }}
                        </td>
                        <td class="px-4 py-2 bg-gray-100">
                            {{ $product->harga }}
                        </td>
                        <td class="px-4 py-2 bg-gray-100 p-1 w-10 h-20">
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="" class="w-full h-full object-cover">
                        </td>
                        <td class="px-4 py-2 bg-gray-100">
                            <a href="{{ url('/product/' . $product->id . '/edit') }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Initialize DataTables
        $(document).ready( function () {
            $('#product-table').DataTable({
                "order": [[0, 1, 2, 3, 4, 5, "asc"]], // Sort by the third column (Type) in ascending order
                "columnDefs": [
                    { "orderable": false, "targets": [6, 7] } // Disable sorting for other columns
                ]
            });
        });
    </script>

@endsection
