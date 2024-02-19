@extends('layouts.base')

@section('container')
{{-- CAROUSEL --}}
<div class="w-ful
          xl:bg-red-200 lg:bg-blue-200 md:bg-green-300 sm:bg-yellow-200 min-[320px] max-[640px]:bg-purple-300
            xl:h-[500px] lg:h-[450px] md:h-[400px] sm:h-[350px] min-[320px] max-[640px]:h-[250px]">
    <div class="glide w-full h-[500px]
                xl:h-[500px] lg:h-[450px] md:h-[400px] sm:h-[350px] min-[320px] max-[640px]:h-[250px]">
        <div class="glide__track w-full" data-glide-el="track">
            <ul class="glide__slides w-full
                       xl:h-[500px] lg:h-[450px] md:h-[400px] sm:h-[350px] min-[320px] max-[640px]:h-[250px]">
                <li class="glide__slide"><img class="w-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpIydx0f-iLo-mn6I27wtO_22LrN35TJCJmQ&usqp=CAU" alt="Image 1"></li>
                <li class="glide__slide"><img class="w-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTd-ETt9QxodObUGkFPQDl9hIBFYSM8jyTj9w&usqp=CAU" alt="Image 2"></li>
                <li class="glide__slide"><img class="w-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMIa956G5ODqyVmXUePBjgRZtxZZ9Fx_eyPw&usqp=CAU" alt="Image 3"></li>
            </ul>
        </div>
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                </svg>
            </button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Glide('.glide', {
            type: 'carousel',
            startAt: 0,
            perView: 1,
            autoplay: 3000, // Set to false if you don't want autoplay
        }).mount();
    });
</script>

<main class="bg-[#0A2974] w-full flex justify-center border-y-2">
    <section class="flex justify-between px-7 w-full">
        <div class="text-yellow-300 w-1/4 h-32 my-2 flex flex-col align-middle items-center justify-center">
            <svg class="text-yellow-300 dark:text-white
                            xl:w-16 lg:w-16 md:w-14 sm:w-12 min-[320px] max-[640px]:w-12
                            xl:h-16 lg:h-16 md:h-14 sm:h-12 min-[320px] max-[640px]:h-12
                            xl: lg: md: sm: min-[320px] max-[640px]:mt-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 11c.9 0 1.4-.5 2.2-1a33.3 33.3 0 0 0 4.5-5.8 1.5 1.5 0 0 1 2 .3 1.6 1.6 0 0 1 .4 1.3L14.7 10M7 11H4v6.5c0 .8.7 1.5 1.5 1.5v0c.8 0 1.5-.7 1.5-1.5V11Zm6.5-1h5l.5.1a1.8 1.8 0 0 1 1 1.4l-.1.9-2.1 6.4c-.3.7-.4 1.2-1.7 1.2-2.3 0-4.8-1-6.7-1.5"/>
            </svg>
            <p class="font-semibold w-fit h-fit text-center
                        xl:text-xl lg:text-lg md:text-base sm:text-sm min-[320px] max-[640px]:text-sm">
                UI SIMPEL & PRAKTIS
            </p>
        </div>
        <div class="text-yellow-300 w-1/4 h-32 my-2 flex flex-col align-middle items-center justify-center">
            <svg class="text-yellow-300 dark:text-white
                            xl:w-16 lg:w-16 md:w-14 sm:w-12 min-[320px] max-[640px]:w-12
                            xl:h-16 lg:h-16 md:h-14 sm:h-12 min-[320px] max-[640px]:h-12
                            xl: lg: md: sm: min-[320px] max-[640px]:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.3L19 7H7.3"/>
            </svg>            
            <p class="font-semibold w-fit h-fit text-center
                        xl:text-xl lg:text-lg md:text-base sm:text-sm min-[320px] max-[640px]:text-sm">
                CART PRODUK
            </p>
        </div>
        <div class="text-yellow-300 w-1/4 h-32 my-2 flex flex-col align-middle items-center justify-center">
            <svg class="text-yellow-300 dark:text-white
                            xl:w-16 lg:w-16 md:w-14 sm:w-12 min-[320px] max-[640px]:w-12
                            xl:h-16 lg:h-16 md:h-14 sm:h-12 min-[320px] max-[640px]:h-12
                            xl: lg: md: sm: min-[320px] max-[640px]:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>            
            <p class="font-semibold w-fit h-fit text-center
                        xl:text-xl lg:text-lg md:text-base sm:text-sm min-[320px] max-[640px]:text-sm">
                CARI PRODUK
            </p>
        </div>
        <div class="text-yellow-300 w-1/4 h-32 my-2 flex flex-col align-middle items-center justify-center">
            <svg class="text-yellow-300 dark:text-white
                            xl:w-16 lg:w-16 md:w-14 sm:w-12 min-[320px] max-[640px]:w-12
                            xl:h-16 lg:h-16 md:h-14 sm:h-12 min-[320px] max-[640px]:h-12
                            xl: lg: md: sm: min-[320px] max-[640px]:mt-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M6 14h2m3 0h5M3 7v10c0 .6.4 1 1 1h16c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H4a1 1 0 0 0-1 1Z"/>
            </svg>            
            <p class="font-semibold w-fit h-fit text-center
                        xl:text-xl lg:text-lg md:text-base sm:text-sm min-[320px] max-[640px]:text-sm">
                PEMBAYARAN DARING
            </p>
        </div>
    </section>
</main>

{{-- MAIN PAGE --}}
<main class="container mx-auto pb-5 pt-10 px-16" id="product">
    <section class="mb-8">
        
        <h2 class="text-4xl font-semibold mb-7 border-b-4 pb-4 border-yellow-300 uppercase flex justify-center">
            PRODUK TERBARU
        </h2>

        <div class="w-full flex justify-center">
            <div class="grid gap-5 text-sm
            xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 min-[320px] max-[640px]:grid-cols-2
            xl:h-full lg:h-full md: sm:h-[760px] min-[320px] max-[640px]:h-[760px]
            xl: lg: md:overflow-hidden sm:overflow-hidden min-[320px] max-[640px]:overflow-hidden">
            
                @foreach ($products->take(10) as $product)
                    <a href="/product/{{ $product->id }}" class="">
                        <div class="bg-white p-4 rounded-md shadow-md flex flex-col justify-between border-[1px]
                        xl:w-[210px] lg: md: sm: min-[320px] max-[640px]:
                        xl:h-[400px] lg: md: sm: min-[320px] max-[640px]:">
                            <div class="">
                                <div class="bg-gray-50 w-full flex justify-center border">
                                    <img class="w-[150px] h-[200px] object-cover" src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
                                </div>
                                <p class="font-semibold mt-2 mb-2 text-lg">
                                    {{ $product->nama_product }}
                                </p>
                                <div class="break-all uppercase rounded-2xl w-fit px-2 border-2">
                                    <p class="font-semibold text-xs">
                                        {{ $product->type->nama_type }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col justify-between gap-3">
                                <span class="text-blue-500 font-semibold">Rp. {{ number_format($product->harga) }}</span>
                                <div class="w-full flex justify-end">
                                    <form action="{{ route('cart.add') }}" method='POST'>
                                        @csrf
                                        @method('post')
                                        <input type="hidden" value="{{ $product->id }}" name="id_product">
                                        <input type="hidden" value="1" name="kuantitas">
                                            <button type="submit" class="bg-yellow-300 w-16 h-9 font-bold hover:brightness-95 uppercase rounded-md">
                                                BELI
                                            </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <a href="/productmain" class="">
            <div class="bg-yellow-300 w-full py-1 mt-8 hover:brightness-95 justify-center flex active:scale-95 transition-all">
                <p class="items-center justify-center flex font-bold
                xl:text-2xl lg:text-2xl md:text-xl sm:text-lg min-[320px] max-[640px]:text-lg">
                    Temukan Lebih Banyak Produk 
                    <svg class="text-gray-800 dark:text-white ml-2
                    xl:w-7 lg:w7 md:w-6 sm:w-5 min-[320px] max-[640px]:w-5
                    xl:h-7 lg:h-7 md:h-6 sm:h-5 min-[320px] max-[640px]:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="3" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" transform="scale (-1, 1)" transform-origin="center"/>
                    </svg>
                </p>
            </div>
        </a>
    </section>
</main>

<main class="bg-[#0A2974] container mx-auto min-w-full py-10 px-10 flex justify-end text-slate-100">
    <div class="w-[850px] text-right">  
        <p class="text-3xl font-bold text-yellow-300">
            Dengan banyak pilihan produk tersedia di katalog kami. Berbagai macam kebutuhan alat kebersihan dapat Anda temukan dengan mudah.
        </p>
        <div class="w-full flex justify-end mt-8">
            <button type="submit" class="font-bold hover:brightness-95 py-2 px-4 border-white border-2">
                LIHAT PRODUK
            </button>
        </div>
    </div> 
</main>



{{-- TUTORIAL --}}
<main class="container mx-auto min-w-full py-16 px-10 justify-center flex" id="tutorial">
    <div class="
    xl:w-3/5 lg:w-3/5 md:w-4/5 sm: min-[320px] max-[640px]:">
        <div class="">
            <p class="font-semibold mb-12
            xl:text-3xl lg:text-3xl md:text-3xl sm:text-2xl min-[320px] max-[640px]:text-xl">
                Langkah-langkah untuk pemesanan barang: 
            </p>
        </div>

        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    1. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a9 9 0 0 0 5-1.5 4 4 0 0 0-4-3.5h-2a4 4 0 0 0-4 3.5 9 9 0 0 0 5 1.5Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">
                        REGISTRASI/LOGIN
                    </strong>
                    – Buat akun baru dengan mengisi data Anda pada form registrasi, atau login jika sudah memiliki akun.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    2. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
                </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">
                        CARI PRODUK
                    </strong>
                    – Pilih barang sesuai kebutuhan yang Anda cari pada laman PRODUK.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    3. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 17h6m-3 3v-6M4.9 4H9c.5 0 .9.4.9.9V9c0 .5-.4.9-.9.9H5a.9.9 0 0 1-.9-.9V5c0-.5.4-.9.9-.9Zm10 0H19c.5 0 .9.4.9.9V9c0 .5-.4.9-.9.9h-4a.9.9 0 0 1-.9-.9V5c0-.5.4-.9.9-.9Zm-10 10H9c.5 0 .9.4.9.9V19c0 .5-.4.9-.9.9H5a.9.9 0 0 1-.9-.9v-4c0-.5.4-.9.9-.9Z"/>
                </svg>         
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">
                        ADD TO CART
                    </strong>
                    – Klik "BELI" untuk menambahkan barang ke keranjang belanja anda.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    4. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.3L19 7h-1M8 7h-.7M13 5v4m-2-2h4"/>
                </svg>   
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">
                        CART
                    </strong>
                    – Periksa kembali belanjaan Anda pada CART. Anda dapat menambah dan mengurangi jumlah barang, atau menghapus barang pada CART Anda.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    5. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M6 14h2m3 0h5M3 7v10c0 .6.4 1 1 1h16c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H4a1 1 0 0 0-1 1Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">
                        CHECKOUT
                    </strong>
                    – Pilih atau buat alamat sebelum "CHECKOUT". Lalu tentukan ekspedisi. Jika sudah, klik "CHECKOUT" untuk proses pembayaran. 
                    Anda dapat membayar langsung melalui rekening dengan saldo cukup.
                    Atau menyimpan sementara pesanan jika ingin dibayar nanti.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    6. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 8h6m-6 4h6m-6 4h6M6 3v18l2-2 2 2 2-2 2 2 2-2 2 2V3l-2 2-2-2-2 2-2-2-2 2-2-2Z"/>
                </svg>            
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">
                        PESANAN
                    </strong>
                    – Pesanan yang belum dibayar akan masuk ke laman PESANAN PENDING, anda dapat bayar di sana. Pesanan yang sudah dibayar akan masuk ke laman PESANAN PAID untuk menunggu proses dan persetujuan dari admin kami.
                </p>
            </div>
        </div>
    </div>
</main>

{{-- FOOTER --}}
<x-footer />
@endsection
