<div class="relative overflow-x-auto">
    <table id="invoice-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 border-b border-gray-300">
            <tr>
                <th scope="col" class="px-4 py-2">
                    Tanggal
                </th>
                {{-- <th scope="col" class="px-4 py-2">
                    Status
                </th> --}}
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
                {{-- <th scope="col" class="px-4 py-2">
                    Harga Barang
                </th>
                <th scope="col" class="px-4 py-2">
                    Ongkir
                </th> --}}
                <th scope="col" class="px-4 py-2">
                    Harga Total
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
                        {{-- <td class="px-4 py-2">
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
                        </td> --}}
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
                        {{-- <td class="px-4 py-2">
                            Rp. {{ number_format($product->harga * $product->kuantitas) }}
                        </td>
                        <td class="px-4 py-2">
                            Rp. {{ number_format ($order->ongkos_kirim) }}
                        </td> --}}
                        <td class="px-4 py-2">
                            Rp. {{ number_format($order->total_harga) }}
                        </td>
                    </tr>                        
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Initialize DataTables
    $(document).ready( function () {
        $('#invoice-table').DataTable({
            "order": [[0, 1, 3, 4, 6, "asc"]], // Sort by the first column (Tanggal) in ascending order
            "columnDefs": [
                { "orderable": false, "targets": [2, 5] } // Disable sorting for other columns
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