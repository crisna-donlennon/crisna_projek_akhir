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
                        <a href="/product/{{ $product->id }}" class="" >
                            <div class="container flex my-5 p-5 bg-white rounded-md shadow-md border-[1px]">
                                <div class="flex w-full h-full">
                                    <div class="flex justify-center mr-5">
                                        <img class="w-[60px] h-[80px] object-cover" src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
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
                                            <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST" class="flex">
                                                @csrf
                                                <input type="hidden" value="decrement" name="action">
                                                <button class="flex text-center items-center justify-center w-8 h-w-8 rounded-md transition-all duration-300 active:scale-95 text-white hover:brightness-125" type="submit">
                                                    <svg class="w-4 h-4 text-black" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <div class="flex items-center justify-center border-x-[1px] px-4">
                                                <p class="">
                                                    {{ $product['pivot']['kuantitas'] }}x
                                                </p>
                                            </div>

                                            <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST" class="flex">
                                                @csrf
                                                <input type="hidden" value="increment" name="action">
                                                <button class="flex text-center items-center justify-center w-8 h-w-8 rounded-md transition-all duration-300 active:scale-95 text-white hover:brightness-125" type="submit" name="action" value="increment">
                                                    <svg class="w-4 h-4 text-black" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <form action="{{ route('cart.delete', ['id' => $product->id]) }}" method="POST" class="">
                                            @csrf
                                            <button class="hover:text-red-600 flex border-x-[1px] border-b-[1px] text-center items-center justify-center w-full" type="submit" name="action" value="delete">
                                                <p class="text-xs py-1">
                                                    HAPUS
                                                </p>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>


                
                {{-- PENGIRIMAN --}}
                <div class="max-w-[331px]">
                    <div class="flex-col h-fit flex my-5 p-6 bg-white border border-gray-300">
                        <div class="">
                            <p class="font-semibold text-lg uppercase flex justify-center underline">
                                PENGIRIMAN
                            </p>
                        </div>
                        <input type="hidden" id="totalWeight" value="{{ $totalWeight }}">
                        @if (!empty($alamats) && count($alamats) > 0)
                            <label class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                                Pilih Alamat: 
                            </label>
                            <select name="selected_address" id="selected_address" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                                <option value="" selected disabled hidden></option>
                                @foreach ($alamats as $alamat)
                                    <option value="{{ $alamat->id }}" data-city-id="{{ $alamat->city_id }}">
                                        {{ $alamat->alamat_detail . ', ' . $alamat->nama_city . ', ' . $alamat->nama_province }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <div class="flex justify-center align-middle items-center mt-1">
                                {{-- <svg class="absolute w-20 h-w-20 text-gray-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                                </svg> --}}
                                <svg class="w-40 h-w-40 text-gray-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.5 10a2.5 2.5 0 1 1 5 .2 2.4 2.4 0 0 1-2.5 2.4V14m0 3h0m9-5a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </div>
                        @endif
                        @if (!empty($alamats) && count($alamats) > 0)
                            <div id="selected_address_display">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Alamat Tujuan Yang Dipilih: 
                                </label>
                                <div id="selected_address_info" class="bg-gray-50 border min-h-[70px] text-gray-600 border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                                    <span id="selected_address_text"></span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Pilih Ekspedisi*
                                </label>
                                <select name="kurir" id="kurir" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                                    <option value="" selected disabled hidden></option>
                                    <option value="jne">
                                        JNE
                                    </option>
                                    <option value="tiki">
                                        TIKI
                                    </option>
                                    <option value="pos">
                                        POS INDONESIA
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Pilih Layanan*
                                </label>
                                <select name="layanan" id="layanan" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-[#0A2974] focus:border-[#0A2974] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#0A2974] dark:focus:border-[#0A2974] mb-3">
                                    <option value="" selected disabled hidden></option>
                                </select>
                            </div>
                        @else
                            <p class="text-[15px] text-gray-400">
                                *Anda belum menambahkan alamat tujuan pengiriman.
                            </p>
                        @endif


                        @if (!empty($alamats) && count($alamats) > 0)
                            <div class="flex justify-between my-5 text-gray-700 font-medium">
                                <div class="flex w-full h-full">
                                    <div class="flex">
                                        <p class="flex items-center">
                                            Ongkir Anda: 
                                        </p>
                                    </div>
                                </div>
                                <div class="w-48">
                                    <div class="flex justify-end pl-4">
                                        <p class="ongkoskirim">
                                            0
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a href="/create-alamat" class="bg-yellow-300 w-full py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                            TAMBAH ALAMAT
                        </a>
                    </div>



                    {{-- CHECKOUT --}}
                    <div class="flex-col h-fit flex my-5 p-6 bg-white border border-gray-300">
                        <div class="">
                            <p class="font-semibold text-lg uppercase flex justify-center underline">
                                CHECKOUT
                            </p>
                        </div>
                        <table class="w-full text-left mt-6">
                            <thead>
                                <tr class="text-gray-700 text-sm">
                                    <th class="w-52 font-semibold uppercase">
                                        BARANG
                                    </th>
                                    <th class="w-40 font-semibold uppercase">
                                        <p class="justify-end flex">
                                            HARGA TOTAL
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $product)
                                    <tr class="text-gray-600">
                                        <td class="">
                                            {{ $product['pivot']['kuantitas'] }}x 
                                            {{ $product->nama_product }}
                                        </td>
                                        <td class="">
                                            <p class="justify-end flex">
                                                Rp. {{ number_format($product['harga'] * $product['pivot']['kuantitas']) }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-between border-b-[1px] pb-1">
                            <div class="flex w-full h-full">
                                <div class="flex">
                                    <p class="flex items-center text-gray-700 font-semibold">
                                        Ongkir: 
                                    </p>
                                </div>
                            </div>
                            <div class="w-48">
                                <div class="flex justify-end pl-4 text-gray-600">
                                    <p class="ongkoskirim">
                                        0
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="w-full">
                                <div class="flex justify-between font-bold">
                                    <p class="font-bold uppercase flex items-center">
                                        TOTAL HARGA: 
                                    </p>
                                    <p class="flex items-center justify-end totalHarga">
                                        Rp. {{ number_format($totalPrice) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex break">
                                    @if (!empty($alamats) && count($alamats) > 0)
                                        <p class="flex items-center"></p>
                                    @else
                                        <p class="text-[15px] text-gray-400 mt-3">
                                            *Anda belum menambahkan alamat tujuan pengiriman.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (!empty($alamats) && count($alamats) > 0)
                            <button class="bg-yellow-300 w-full py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold" type="button" id="checkoutButton">
                                CHECKOUT
                            </button>
                        @else
                            <button class="bg-gray-300 w-full py-1 mt-2 cursor-not-allowed opacity-50 justify-center flex items-center text-lg font-bold" type="button" id="checkoutButton" disabled>
                                CHECKOUT
                            </button>
                        @endif
                    </div>
                </div>
            @else
                <div class="container flex mx-auto my-8 p-5 pl-8 bg-white rounded-md shadow-md w-11/12 border-[1px] flex-col justify-between">
                    <a href="/productmain" class="text-gray-400 text-lg items-center w-full h-full flex justify-center hover:text-[#0a2a74cb] transition duration-300 ease-in-out">
                        Keranjang Anda kosong. Klik untuk melihat katalog produk
                    </a>
                </div>
            @endif
        </div>

        <input type="hidden" name="kurir" id="nama_kurir" value="">
        <input type="hidden" name="layanan" id="nama_layanan" value="">
        <input type="hidden" name="ongkos_kirim" id="ongkos_kirim" value="">

        <script>
            $(document).ready(function() {
                var harga_ongkir = 0;

                const totalPrice = {!! json_encode($totalPrice) !!}

                let selectedAlamatId = null;

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
                                payment_status: 'pending',
                                kurir: $('#nama_kurir').val(),
                                layanan: $('#nama_layanan').val(),
                                ongkos_kirim: $('#ongkos_kirim').val(),
                                alamat_id: selectedAlamatId,
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
                    var selectedOption = $(this).find(':selected');
                    var cityId = selectedOption.data('city-id');
                    var addressText = selectedOption.text();
                    selectedAlamatId = $(this).val();
                    $('#selected_address_text').text(addressText);
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

                    $('#nama_kurir').val($("select[name=kurir]").find(':selected').text());

                    jQuery.ajax({
                        url: "/origin=" + origin + "&destination=" + destination + "&weight=" +
                            weight +
                            "&courier=" + courier,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="layanan"]').prop('disabled', false)
                            $('select[name="layanan"]').empty();


                            $('select[name="layanan"]').append($('<option>').attr('value', '').text(
                                'Pilih Layanan'));
                            $.each(data, function(key, value) {
                                $.each(value.costs, function(key1, value1) {
                                    $.each(value1.cost, function(key2, value2) {
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
                            let defaultLayanan = $('select[name="layanan"]').find(':selected');
                            updateLayananHiddenInput(defaultLayanan);
                        }
                    });
                });

                // Ambil ongkir
                $('select[name="layanan"]').on('change', function() {
                    // Get the selected option
                    var selectedOption = $(this).find(':selected');
                    updateLayananHiddenInput(selectedOption);

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
                    $('#ongkos_kirim').val(harga_ongkir);
                    $(".totalHarga").text(number_format.format(totalHarga));
                });

                function updateLayananHiddenInput(selectedOption) {
                    // Set the selected layanan to the hidden input
                    $('#nama_layanan').val(selectedOption.attr('data-service') + ' - ' +
                        selectedOption.attr('data-description') + ' - ' +
                        selectedOption.attr('data-value'));
                }

            });
        </script>
    </main>
@endsection
