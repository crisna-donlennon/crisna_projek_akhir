@extends('layouts.base')

@section('container')
  
<a href="/home">
    <button type="button" class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
</a>
<div class="container mx-auto my-8 p-8 bg-white rounded-md shadow-md w-11/12">
    {{-- {{ $product }} --}}
    <!-- Product Image -->
    <img src="{{ asset('storage/'.$product[0]->gambar) }}" alt="Product Image" class="w-full h-64 object-cover mb-4 rounded-md">
    
    <!-- Product Information -->
    <div class="mb-4">
        <h1 class="text-2xl font-semibold">{{ $product[0]->nama_product }}</h1>
        <p class="text-gray-600">{{ $product[0]->deskripsi }}</p>
    </div>
    
    <!-- Price Tag -->
    <div class="flex items-center justify-between">
        <span class="text-2xl font-semibold text-blue-500">Rp. {{ $product[0]->harga }}</span>
        <!-- Add to Cart button can be placed here -->
    </div>
    
</div>







<div class="container ml-5 bg-white rounded-md shadow-md w-6/12 flex h-[1000px] mb-5">
    <!-- Product Image -->
    <div class="w-1/2 p-5">
        <img src="{{ asset('storage/'.$product[0]->gambar) }}" alt="Product Image" class="w-full h-64 object-cover mb-4 rounded-md">
        
        <!-- Product Information -->
        <div class="mb-4">
            <h1 class="text-2xl font-semibold">{{ $product[0]->nama_product }}</h1>
            <p class="text-gray-600">{{ $product[0]->deskripsi }}</p>
        </div>
        
        <!-- Price Tag -->
        <div class="flex items-center justify-between">
            <span class="text-2xl font-semibold text-blue-500">Rp. {{ $product[0]->harga }}</span>
            <!-- Add to Cart button can be placed here -->
        </div>
    </div>


    <div class="w-1/2 shadow-[-2px_0px_4px_0px_rgba(0,0,0,0.1)] border-l-[1px] border-gray-200">        
        <p>AHAHAHAHAHAH</p>
    </div>
</div>





<div class="container ml-5 bg-white rounded-md shadow-md w-6/12 flex h-[1000px] mb-5">
    <!-- Product Image -->
    <div class="w-1/2 p-5">
        <img src="{{ asset('storage/'.$product[0]->gambar) }}" alt="Product Image" class="w-full h-64 object-cover mb-4 rounded-md">
        
        <!-- Product Information -->
        <div class="mb-4">
            <h1 class="text-2xl font-semibold">{{ $product[0]->nama_product }}</h1>
            <p class="text-gray-600">{{ $product[0]->deskripsi }}</p>
        </div>
        
        <!-- Price Tag -->
        <div class="flex items-center justify-between">
            <span class="text-2xl font-semibold text-blue-500">Rp. {{ $product[0]->harga }}</span>
            <!-- Add to Cart button can be placed here -->
        </div>
    </div>
</div>

@endsection