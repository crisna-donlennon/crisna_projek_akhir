@extends('dashboard.main')

@section('header')
<div class="flex justify-between">
    <p class="text-lg flex w-fit font-semibold">
        INVOICES
    </p>
    <a href="/dashboard/invoice/export_excel" class="btn btn-primary font-medium text-gray-500 hover:text-[#0A2974] flex align-middle items-center" target="_blank">
        
    </a>
    <a href="/dashboard/create-product">
        <button type="button" class="flex text-gray-500 hover:text-[#0A2974] uppercase">
            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
            </svg>            
            <p class="ml-2 pt-[1px] font-medium">
                CETAK EXCEL
            </p>
        </button>
    </a>
</div>
@endsection

@section('content') 
    <div class="relative overflow-x-auto">
        <table id="invoice-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-4 py-2">
                        Tanggal
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Status
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Order ID
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Nama Pelanggan
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Alamat
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Barang
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Harga Total
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Konfirmasi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedOrders as $status => $orders)
                    @foreach($orders as $order)
                        @php
                            $firstOrder = $order;
                            $orderItems = $firstOrder['order_items'];
                            $order->load('orderItems');
                        @endphp

                        <tr class="invoice-row odd:bg-slate-50 odd:dark:bg-gray-900 even:bg-slate-100 even:dark:bg-gray-800 border-b dark:border-gray-700" data-invoice-id="{{ $order->id }}">
                            <td class="px-4 py-2">
                                {{ $order->created_at }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($order->status == 'Menunggu Konfirmasi')
                                    <span class="text-orange-400 tracking-tight dark:text-white flex uppercase">
                                        {{ $order->status }}
                                    </span>
                                @elseif ($order->status == 'Proses')
                                    <span class="text-blue-400 tracking-tight dark:text-white flex uppercase">
                                        {{ $order->status }}
                                    </span>
                                @elseif ($order->status == 'Selesai')
                                    <span class="text-green-400 tracking-tight dark:text-white flex uppercase">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ $order->unique_string }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $order->user->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $order->alamat->alamat_detail . ', ' . $order->alamat->nama_city . ', ' . $order->alamat->nama_province . ', ' . $order->alamat->kode_pos }}
                            </td>
                            <td class="px-4 py-2">
                                @foreach ($order->orderItems as $product)
                                    {{ $product->kuantitas }}x {{ $product->nama_product }}<br>
                                @endforeach
                            </td>
                            <td class="px-4 py-2">
                                Rp. {{ number_format($order->total_harga) }}
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex w-full justify-between mt-2">
                                    <div class="w-full">
                                        @if ($order->status == 'Menunggu Konfirmasi')
                                            <form action="/order/terima" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id_order" value="{{ $order->id }}">
                                                <button type="submit" class="bg-gray-100 border-[1px] px-3 rounded-md w-full hover:brightness-95 justify-center flex items-center font-semibold">
                                                    Terima
                                                </button>                    
                                            </form>
                                        @elseif ($order->status == 'Proses')
                                            <form action="/order/selesai" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id_order" value="{{ $order->id }}">
                                                <button type="submit" class="bg-gray-100 border-[1px] px-3 rounded-md w-full hover:brightness-95 justify-center flex items-center font-semibold">
                                                    Selesai
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>                        
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Container for hidden invoice details -->
        <div id="invoice-details-container">
            @foreach ($groupedOrders as $status => $orders)
                @foreach($orders as $order)
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
            @endforeach
        </div>
    
    </div>

    <script>
        // Initialize DataTables
        $(document).ready( function () {
            $('#invoice-table').DataTable({
                "order": [[0, 1, 3, 4, 5, "asc"]], // Sort by the first column (Tanggal) in ascending order
                "columnDefs": [
                    { "orderable": false, "targets": [2, 7] } // Disable sorting for other columns
                ]
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const invoiceRows = document.querySelectorAll('.invoice-row');

            invoiceRows.forEach(function(invoiceRow) {
                invoiceRow.addEventListener('click', function() {
                    const invoiceId = invoiceRow.dataset.invoiceId;
                    const invoiceDiv = document.getElementById(`invoice_${invoiceId}`);
                    const closeInvoiceButton = document.getElementById(`closeInvoice_${invoiceId}`);

                    if (invoiceDiv) {
                        invoiceDiv.classList.toggle('hidden');
                    }

                    if (closeInvoiceButton) {
                        closeInvoiceButton.addEventListener('click', () => {
                            invoiceDiv.classList.add('hidden');
                        });
                    }
                });
            });
        });
    </script>

@endsection
