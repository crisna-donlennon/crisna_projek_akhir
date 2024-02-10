@extends('layouts.base')

@section('head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection

@section('container')
    <main class="container mx-auto pb-5 pt-10 px-16" id="product">

        <h2 class="text-4xl font-semibold border-b-4 pb-8 border-[#0A2974] uppercase flex justify-center">
            CART
        </h2>

        @php
            $productData = [];
            foreach ($cartItems as $item) {
                $productData[] = $item;
            }
            $totalWeight = 0;
            foreach ($cartItems as $item) {
                $productWeight = $item->berat;
                $quantity = $item->pivot->kuantitas;
                $totalWeight += $productWeight * $quantity;
            }
        @endphp

        <div class="flex justify-center gap-7">
            @if ($totalPrice !== 0)
                <div class="w-3/5">
                    @foreach ($cartItems as $product)
                        <div class="container flex my-5 p-5 bg-white rounded-md shadow-md border-[1px]">
                            <div class="flex w-full h-full">
                                <div class="flex justify-center mr-5">
                                    <img class="w-[60px] h-[80px] object-cover"
                                        src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
                                </div>
                                <div class="flex font-medium pt-1">
                                    <p>{{ $product['nama_product'] }}</p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between w-full mb-2 px-1">
                                    <p class="">
                                        Rp.
                                    </p>
                                    <p class="">
                                        {{ number_format($product['harga'] * $product['pivot']['kuantitas']) }}
                                    </p>
                                </div>

                                <div class="flex-col justify-between">
                                    <div class="flex justify-between border-[1px] ">
                                        <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST"
                                            class="flex">
                                            @csrf
                                            <input type="hidden" value="decrement" name="action">
                                            <button
                                                class="flex text-center items-center justify-center w-8 h-w-8 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                                type="submit">
                                                <svg class="w-4 h-4 text-black" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                </svg>
                                            </button>
                                        </form>

                                        <div class="flex items-center justify-center border-x-[1px] px-4">
                                            <p class="">{{ $product['pivot']['kuantitas'] }}x</p>
                                        </div>

                                        <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST"
                                            class="flex">
                                            @csrf
                                            <input type="hidden" value="increment" name="action">
                                            <button
                                                class="flex text-center items-center justify-center w-8 h-w-8 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                                type="submit" name="action" value="increment">
                                                <svg class="w-4 h-4 text-black" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <form action="{{ route('cart.delete', ['id' => $product->id]) }}" method="POST"
                                        class="">
                                        @csrf
                                        <button
                                            class="hover:text-red-500 flex border-x-[1px] border-b-[1px] text-center items-center justify-center w-full"
                                            type="submit" name="action" value="delete">
                                            <p class="text-xs py-1">
                                                HAPUS
                                            </p>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="max-w-[331px]">
                    <div class="rounded-md flex-col h-fit flex my-5 px-5 py-4 bg-white text-sm border-[1px]">
                        <div class="">
                            <p class="font-semibold text-lg uppercase flex justify-center underline pb-5">
                                Pengiriman
                            </p>
                        </div>
                        {{-- totalWeigth --}}
                        <input type="hidden" id="totalWeight" value="{{ $totalWeight }}">

                        @if (!empty($alamats) && count($alamats) > 0)
                            <label class="block text-sm font-medium text-gray-600">Pilih Alamat:</label>
                            <select name="selected_address" id="selected_address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-3">
                                <option value="">Pilih Alamat</option>
                                @foreach ($alamats as $alamat)
                                    <option value="{{ $alamat->id }}" data-city-id="{{ $alamat->city_id }}">
                                        {{ $alamat->alamat_detail . ', ' . $alamat->nama_city . ', ' . $alamat->nama_province }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select name="selected_address" id="selected_address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-3">
                                <option value="">
                                    Tambah alamat terlebih dahulu
                                </option>
                            </select>
                        @endif

                        @if (!empty($alamats) && count($alamats) > 0)
                            <div id="selected_address_display">
                                <label class="block text-sm font-medium text-gray-600">Alamat Yang Dipilih:</label>
                                <div id="selected_address_info"
                                    class="break-words border-gray-300 rounded-lg border p-3 mb-3">
                                    <p>Alamat :
                                        <span id="selected_address_text">Pilih Alamat terlebih dahulu</span>
                                    </p>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label class="block text-sm font-medium text-gray-600">Pilih Ekspedisi<span>*</span>
                                </label>
                                <select name="kurir" id="kurir"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-3">
                                    <option value="">Pilih kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS INDONESIA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium text-gray-600">Pilih Layanan<span>*</span>
                                </label>
                                <select name="layanan" id="layanan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-3">
                                    <option value="">Pilih layanan</option>
                                </select>
                            </div>
                        @else
                            <p class="font-semibold text-center mt-2">Pilih alamat terlebih dahulu</p>
                        @endif


                        @if (!empty($alamats) && count($alamats) > 0)
                            <div class="flex justify-between border-y-[1px] pb-[2px] mt-1">
                                <div class="flex w-full h-full">
                                    <div class="flex font-medium break">
                                        <p class="flex items-center">
                                            Ongkir:
                                        </p>
                                    </div>
                                </div>

                                <div class="w-48">
                                    <!-- You can also add buttons for updating quantity or removing the product -->
                                    <div class="flex justify-between pl-4">
                                        <p class="">
                                            Rp.
                                        </p>
                                        <p class="ongkoskirim">0</p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <a href="/create-alamat"
                            class="bg-yellow-300 mt-12 w-full flex items-center justify-center h-9 font-bold hover:brightness-95 uppercase ">
                            TAMBAH ALAMAT
                        </a>
                    </div>
                    <div class="rounded-md flex-col h-fit flex my-5 px-5 py-4 bg-white text-sm border-[1px]">
                        <div class="">
                            <p class="font-semibold text-lg uppercase flex justify-center underline pb-5">
                                CHECKOUT
                            </p>
                        </div>



                        @foreach ($cartItems as $product)
                            <div class="container flex">
                                <div class="flex w-full h-full">
                                    <div class="flex font-medium break">
                                        <p class="flex items-center">
                                            {{ $product['nama_product'] }}
                                        </p>
                                    </div>
                                </div>

                                <div class="w-48">
                                    <!-- You can also add buttons for updating quantity or removing the product -->
                                    <div class="flex justify-between pl-4">
                                        <p class="flex items-center">
                                            Rp.
                                        </p>
                                        <p class="flex items-center">
                                            {{ number_format($product['harga'] * $product['pivot']['kuantitas']) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="flex justify-between border-y-[1px] pb-[2px] mt-1">
                            <div class="flex w-full h-full">
                                <div class="flex font-medium break">
                                    <p class="flex items-center">
                                        Ongkir:
                                    </p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between pl-4">
                                    <p class="">
                                        Rp.
                                    </p>
                                    <p class="ongkoskirim">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mt-2">
                            <div class="flex w-full h-full">
                                <div class="flex font-medium break">
                                    <p class="font-bold uppercase flex items-center">
                                        TOTAL HARGA:
                                    </p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between pl-4 font-bold">
                                    <p class="flex items-center">
                                        Rp.
                                    </p>
                                    <p class="flex items-center totalHarga">
                                        {{ number_format($totalPrice) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button class="bg-yellow-300 mt-12 w-full h-9 font-bold hover:brightness-95 uppercase"
                            type="button" id="checkoutButton">
                            CHECKOUT
                        </button>
                    </div>
                </div>
            @else
                <div
                    class="container flex mx-auto my-8 p-5 pl-8 bg-white rounded-md shadow-md w-11/12 flex-col justify-between">
                    <p class="text-gray-500 text-lg">
                        Keranjang Anda kosong.
                    </p>
                </div>
            @endif
        </div>

        <script>
            $(document).ready(function() {
                var harga_ongkir = 0;

                const totalPrice = {!! json_encode($totalPrice) !!}

                $("#checkoutButton").click(function(event) {
                    event.preventDefault();
                    if (harga_ongkir == 0) {
                        return
                    }

                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

                    const productData = ({!! json_encode($productData) !!});

                    fetch('order/pay-and-create', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            credentials: 'include',
                            body: JSON.stringify({
                                productData: productData,
                                totalPrice: totalPrice + harga_ongkir,
                                id_cart: productData[0].pivot.id_cart,
                                payment_status: 'pending'
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            snap.pay(data.snap_token.snap_token, {
                                onSuccess: function(result) {
                                    window.location.href = '/order/pesanan-paid'
                                },
                                onPending: function(result) {
                                    window.location.href = '/order/pesanan-pending'
                                },
                                onClose: function(result) {
                                    window.location.href = '/order/pesanan-pending'
                                }
                            });
                        })
                        .catch(error => {
                            console.error('Error during fetch:', error);
                        });
                })

                // Gae ngerubah selected alamat
                $('select[name="selected_address"]').on('change', function() {
                    // Get the selected option
                    var selectedOption = $(this).find(':selected');

                    // Get the city ID from the data attribute
                    var cityId = selectedOption.data('city-id');

                    // Get the selected address text
                    var addressText = selectedOption.text();

                    // Update the displayed address information
                    $('#selected_address_text').text(addressText);

                    // Log the selected city ID (optional)
                    console.log("Selected City ID:", cityId);
                });


                // cek ekspedisi
                $('select[name="selected_address"], select[name="kurir"]').on('change', function() {
                    $('select[name="layanan"]').prop('disabled', true).html(
                        '<option value="">Loading...</option>');
                    let origin = 444;
                    let destination = $('select[name="selected_address"]').find(':selected').data('city-id');
                    console.log(destination);
                    let courier = $("select[name=kurir]").val();
                    let weight = $("#totalWeight").val();
                    jQuery.ajax({
                        url: "/origin=" + origin + "&destination=" + destination + "&weight=" +
                            weight +
                            "&courier=" + courier,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="layanan"]').prop('disabled', false)
                            $('select[name="layanan"]').empty();
                            // ini untuk looping data result nya
                            $('select[name="layanan"]').append($('<option>').attr('value', '').text(
                                'Pilih Layanan'));
                            $.each(data, function(key, value) {
                                // Loop through each service
                                $.each(value.costs, function(key1, value1) {
                                    // Loop through each cost
                                    $.each(value1.cost, function(key2, value2) {
                                        // Append an option to the select element with the relevant data attributes
                                        $('select[name="layanan"]').append(
                                            $('<option>').attr('value',
                                                key)
                                            .attr('data-service', value1
                                                .service)
                                            .attr('data-description',
                                                value1.description)
                                            .attr('data-value', value2
                                                .value)
                                            .text(value1.service +
                                                ' - ' + value1
                                                .description + ' - ' +
                                                value2.value)
                                        );
                                    });
                                });
                            });
                        }
                    });
                });

                // Ambil ongkir
                $('select[name="layanan"]').on('change', function() {
                    // Get the selected option
                    var selectedOption = $(this).find(':selected');

                    // Retrieve the data-value attribute
                    harga_ongkir = selectedOption.data("value");

                    var totalHarga = totalPrice + harga_ongkir;

                    var number_format = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    });

                    // Menampilkan hasil nama harga ongkir dari select layanan yang kita pilih
                    $(".ongkoskirim").text(number_format.format(harga_ongkir));
                    $(".totalHarga").text(number_format.format(totalHarga));
                });



            });
        </script>
    </main>
@endsection
