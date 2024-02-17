@extends('pesanan.basePesanan')

@section('content')
    <main class="container mx-auto pb-5 pt-10 px-16" id="product">
        <h2 class="text-4xl font-semibold border-b-4 pb-8 border-[#0A2974] uppercase flex justify-center">
            PESANAN LUNAS
        </h2>
    </main>

    @if ($orderDataPaid->count() > 0)
        <div class="w-full grid grid-cols-3 my-10 gap-4 px-10">
            @foreach ($orderDataPaid as $order)
                @php
                    $firstOrder = $order;
                    $orderItems = $firstOrder['order_items'];
                    $order->load('orderItems');
                @endphp



                {{-- CARD VIEW --}}
                <div id="toggleButton_{{ $order->id }}" data-order-id="{{ $order->id }}" class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow col-span-1 cursor-pointer">
                    <div class="absolute top-0 left-0 w-full rounded-t-lg">
                        <div class="">
                            @if ($order->status == 'Menunggu Konfirmasi')
                                <p class="bg-orange-400 tracking-tight dark:text-white flex justify-center rounded-t-lg py-2 uppercase text-xl font-semibold">
                                    {{ $order->status }}
                                </p>
                            @elseif ($order->status == 'Proses')
                                <p class="bg-blue-400 tracking-tight dark:text-white flex justify-center rounded-t-lg py-2 uppercase text-xl font-semibold">
                                    {{ $order->status }}
                                </p>
                            @elseif ($order->status == 'Selesai')
                                <p class="bg-green-400 tracking-tight dark:text-white flex justify-center rounded-t-lg py-2 uppercase text-xl font-semibold">
                                    {{ $order->status }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex w-full justify-between border-b-2 pb-2 mt-10">
                        <div class="flex-col">
                            <span class="text-[10px]">
                                Tanggal: 
                            </span>
                            <p class="mb-2 text-sm font-semibold tracking-tight text-gray-600">
                                {{ $order->created_at }}
                            </p>
                            <p class="mb-2 text-lg font-semibold tracking-tight">
                                {{ $firstOrder->user->name }}
                            </p>        
                            <span class="text-[10px]">
                                Alamat: 
                            </span>
                            <p class="text-sm font-semibold tracking-tight text-gray-600">
                                {{ $order->alamat->alamat_detail . ', ' . $order->alamat->nama_city . ', ' . $order->alamat->nama_province . ', ' . $order->alamat->kode_pos }}
                            </p>
                        </div>
                        <div class="">
                            <span class="text-[10px]">
                                Order id: 
                            </span>
                            <p class="mb-2 text-sm font-semibold tracking-tight text-gray-600">
                                {{ $order->unique_string }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <div class="text-lg font-bold">
                            Total: 
                        </div>
                        <div class="font-bold text-xl">
                            Rp. {{ number_format($order->total_harga) }}
                        </div>
                    </div>
                </div>



                {{-- CLICK VIEW --}}
                <div id="invoice_{{ $order->id }}" class="hidden bg-[rgba(0,0,0,0.5)] min-h-screen overflow-y-auto bg-overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 py-10">
                    <div class="relative w-fit bg-white rounded-lg z-50 shadow-lg px-8 py-10 mx-auto top-0 max-w-2xl">
                        <div id="closeInvoice_{{ $order->id }}" class="absolute top-0 right-0 w-fit h-fit cursor-pointer m-2 hover:brightness-125">
                            <svg class="w-8 h-8 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </div>
                        <div class="font-bold text-2xl pb-4 uppercase border-b-2">
                            FAKTUR
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex w-full justify-between border-b-2 pb-4">
                                <div class="flex-col">
                                    <span class="text-xs">
                                        Tanggal: 
                                    </span>
                                    <p class="mb-2 text-sm font-medium tracking-tight text-gray-600">
                                        {{ $order->created_at }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold tracking-tight">
                                        {{ $firstOrder->user->name }}
                                    </p>

                                    <div class="mb-2">
                                        <span class="text-[10px]">
                                            Status: 
                                        </span>
                                        @if ($order->status == 'Menunggu Konfirmasi')
                                            <p class="text-orange-400 tracking-tight dark:text-white flex uppercase">
                                                {{ $order->status }}
                                            </p>
                                        @elseif ($order->status == 'Proses')
                                            <p class="text-blue-400 tracking-tight dark:text-white flex uppercase">
                                                {{ $order->status }}
                                            </p>
                                        @elseif ($order->status == 'Selesai')
                                            <p class="text-green-400 tracking-tight dark:text-white flex uppercase">
                                                {{ $order->status }}
                                            </p>
                                        @endif
                                    </div>
                                    <span class="text-xs">
                                        Alamat: 
                                    </span>
                                    <p class="text-sm font-medium tracking-tight text-gray-600">
                                        {{ $order->alamat->alamat_detail . ', ' . $order->alamat->nama_city . ', ' . $order->alamat->nama_province . ', ' . $order->alamat->kode_pos }}
                                    </p>
                                </div>
                                <div class="">
                                    <span class="text-xs">
                                        Order id: 
                                    </span>
                                    <p class="mb-2 text-sm font-medium tracking-tight text-gray-600">
                                        {{ $order->unique_string }}
                                    </p>
                                </div>
                            </div>       
                        </div>
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-700">
                                    <th class="w-52 font-semibold uppercase pr-3">
                                        BARANG
                                    </th>
                                    <th class="font-semibold uppercase">
                                        <p class="justify-center flex">
                                            BERAT
                                        </p>
                                    </th>
                                    <th class="font-semibold uppercase px-7">
                                        <p class="justify-end flex">
                                            HARGA SATUAN
                                        </p>
                                    </th>
                                    <th class="font-semibold uppercase">
                                        <p class="justify-end flex">
                                            HARGA TOTAL
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $product)
                                    <tr class="text-gray-600">
                                        <td class="pr-3">
                                            {{ $product->kuantitas }}x 
                                            {{ $product->nama_product }}
                                        </td>
                                        <td class="">
                                            <p class="justify-center flex">
                                                {{ ($product->berat * $product->kuantitas) }} gram
                                            </p>
                                        </td>
                                        <td class="px-7">
                                            <p class="justify-end flex">
                                                Rp. {{ number_format($product->harga) }}
                                            </p>                                                
                                        </td>
                                        <td class="">
                                            <p class="justify-end flex">
                                                Rp. {{ number_format($product->harga * $product->kuantitas) }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="w-full flex justify-between items-center border-b-2 pb-1 mt-1">
                            <p class="font-semibold text-gray-700">
                                Ongkir: 
                            </p>
                            <p class="text-gray-600">
                                Rp. {{ number_format ($order->ongkos_kirim) }}
                            </p>
                        </div> 
                        <div class="flex justify-between mt-3">
                            <div class="font-bold text-xl">
                                Total: 
                            </div>
                            <div class="font-bold text-xl">
                                Rp. {{ number_format($order->total_harga) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="w-full mx-auto text-center">
            <p class="text-gray-400 items-center w-full h-full flex justify-center text-3xl mt-32">
                Belum ada order apapun yang kamu buat.
            </p>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[id^="toggleButton"]');

            toggleButtons.forEach(function(toggleButton) {
                toggleButton.addEventListener('click', function() {
                    const orderId = toggleButton.dataset.orderId;
                    const invoiceDiv = document.getElementById(`invoice_${orderId}`);
                    const closeInvoiceButton = document.getElementById(`closeInvoice_${orderId}`);
                    const deleteButton = document.getElementById(`delete-button_${orderId}`);
                    const payButton = document.getElementById(`pay-button_${orderId}`);

                    if (!event.target.closest('#delete-button') && !event.target.closest(
                            '.pay-button')) {
                        if (invoiceDiv) {
                            invoiceDiv.classList.toggle('hidden');
                        }
                        if (closeInvoiceButton) {
                            closeInvoiceButton.addEventListener('click', () => {
                                invoiceDiv.classList.add('hidden');
                            });
                        }
                    }
                });
            });

            const paymentButtons = document.querySelectorAll('[id^="pay-button"]');

            paymentButtons.forEach(function(paymentButton) {
                paymentButton.addEventListener('click', function() {
                    const snapToken = paymentButton.dataset.snapToken;

                    try {
                        snap.pay(snapToken, {
                            onSuccess: function(result) {
                                window.location.href = '/order/pesanan'
                            },
                            onPending: function(result) {
                                window.location.href = '/order/pesanan'
                            },
                            onClose: function(result) {
                                window.location.href = '/order/pesanan'
                            }
                        });
                    } catch (error) {
                        console.error('Error during fetch:', error);
                    };

                });
            });
            const paymentButtons2 = document.querySelectorAll('[id^="pay-button2"]');

            paymentButtons2.forEach(function(paymentButton) {
                paymentButton.addEventListener('click', function() {
                    const snapToken = paymentButton.dataset.snapToken;

                    try {
                        snap.pay(snapToken, {
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
                    } catch (error) {
                        console.error('Error during fetch:', error);
                    };

                });
            });
        });
    </script>


@endsection
