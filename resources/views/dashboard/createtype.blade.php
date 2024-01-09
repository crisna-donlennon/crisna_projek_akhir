@extends('dashboard.main')

@section('content')
<a href="/dashboard/create-type">
    <button type="button" class="absolute right-16 top-[70px] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 ">Tambah type</button>
</a>
<div class="flex bg-green-200 justify-between">
    <div class="relative flex overflow-x-auto shadow-xl sm:rounded-lg w-1/2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 justify-between">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $types as $type )
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-5 py-4">
                        {{ $type->nama_type }}
                    </td>
                    <td class="px-5 py-4">
                        <form class="max-w-sm mx-auto" action="{{ '/dashboard/type/'.$type->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus Produk</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="relative pl-5">
        <form class="" action="/dashboard/type" method="POST">
            @csrf
            @method('post')
            <label for="nama_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Type</label>
            <input type="text" name="nama_type" id="nama_type" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
        </form>
    </div>
</div>


@endsection