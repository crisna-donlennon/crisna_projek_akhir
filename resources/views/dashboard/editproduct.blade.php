@extends('dashboard.main')

@section('content')
<p class="absolute top-16 text-xl rounded-md p-3 bg-white">Update Product</p>
<form class="max-w-sm mx-auto" action="{{ '/product/'.$product->id }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('put')
    <div class="mb-5">
      <label for="nama_product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
      <input type="text" value="{{ $product->nama_product }}" name="nama_product" id="nama_product" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    </div>
    <div class="mb-5">

      <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label>
      <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi Produk">{{ $product->deskripsi }}</textarea>
      
    </div>
    <div class="mb-5">
      <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Produk</label>
      <input type="number" value="{{ $product->stok }}" name="stok" id="stok" min="1" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    </div>
    <div class="mb-5">
      <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Produk</label>
      <input type="number" value="{{ $product->harga }}" name="harga" id="harga" min="1" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    </div>
    <div class="mb-5">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Upload file</label>
       <input class="block w-full h-10 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="gambar" id="gambar" type="file">
       <img src="{{ asset('storage/'.$product->gambar) }}" alt="Product Image" class="w-full h-64 object-cover mb-4 rounded-md">
    </div>
    <div class="flex items-start mb-5">
      <label for="type_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Produk</label>
      <select id="type_id" name="type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected value="{{ $product->type_id }}">{{ $product->type }}</option>
        @foreach ($types as $type)
        <option value="{{ $type->id }}">{{ $type->nama_type }}</option>
        @endforeach
      </select>
      
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Produk</button>
  </form>

  <form class="max-w-sm mx-auto" action="{{ '/dashboard/product/'.$product->id }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus Produk</button>
  </form>
@endsection