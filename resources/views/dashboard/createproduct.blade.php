@extends('dashboard.main')

@section('header')
<div class="flex justify-between">
    <p class="text-lg flex w-fit font-semibold">
      TAMBAH PRODUK BARU
    </p>
</div>
@endsection


@section('content')
<form class="max-w-sm mx-auto" action="/dashboard/create-product" method="POST" enctype="multipart/form-data">
  @csrf
  @method('post')
    <div class="mb-5">
      <label for="nama_product" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
        Nama Produk
      </label>
      <input type="text" name="nama_product" id="nama_product" autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3" required>
    </div>
    <div class="mb-5">
      <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
        Deskripsi Produk
      </label>
      <textarea id="deskripsi" name="deskripsi" rows="4" autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3" placeholder="Deskripsi Produk" required></textarea>
    </div>
    <div class="mb-5">
      <label for="stok" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
        Stok Produk
      </label>
      <input type="number" name="stok" id="stok" min="1" autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3" required>
    </div>
    <div class="mb-5">
      <label for="berat" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
        Berat Produk
      </label>
      <input type="number" name="berat" id="berat" min="1" autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3" required>
    </div>
    <div class="mb-5">
      <label for="harga" class="block text-sm font-medium text-gray-700 mb-1 mt-6">
        Harga Produk
      </label>
      <input type="number" name="harga" id="harga" min="1" autocomplete="off" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3" required>
    </div>
    <div class="mb-5">
      <label class="block text-sm font-medium text-gray-700 mb-1 mt-6" for="gambar">
        Upload file
      </label>
       <input class="block w-full rounded-l-sm text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="gambar" id="gambar" type="file" required>
    </div>
    <div class="flex items-start mb-5">
      <label for="type_id" class="block text-sm font-medium text-gray-700 mb-1">
        Tipe Produk
      </label>
      <select id="type_id" name="type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        <option value="" selected disabled hidden></option>
        @foreach ($types as $type)
          <option value="{{ $type->id }}">
            {{ $type->nama_type }}
          </option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-full py-1 mt-2 mb-3 hover:brightness-95 justify-center flex items-center text-lg font-bold">
      Tambah Produk
    </button>
  </form>
  
@endsection