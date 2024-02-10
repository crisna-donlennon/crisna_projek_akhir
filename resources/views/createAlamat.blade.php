@extends('layouts.base')

@section('container')
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 border rounded shadow">
            <h2 class="text-2xl font-semibold mb-6">Tambah Alamat</h2>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('alamat.store') }}">
                @csrf
                @method('POST')

                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-600">Provinsi Tujuan</label>
                    <select name="province_id" id="province_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Provinsi Tujuan</option>
                        @foreach ($provinsi as $row)
                            <option value="{{ $row['province_id'] }}" data-namaprovinsi="{{ $row['province'] }}">
                                {{ $row['province'] }}</option>
                        @endforeach
                    </select>

                    <input type="hidden" name="nama_province" id="nama_province" value="">
                </div>

                <div class="mb-4 ">
                    <label class="block text-sm font-medium text-gray-600">Kota Tujuan<span>*</span>
                    </label>
                    <select name="city_id" id="kota_id"
                        class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Kota</option>
                    </select>

                    <input type="hidden" name="nama_city" id="nama_city" value="">
                </div>

                <div class="mb-4">
                    <label for="alamat_detail" class="block text-sm font-medium text-gray-600">Alamat detail</label>
                    <textarea type="text" name="alamat_detail" id="alamat_detail" class="mt-1 p-2 border rounded w-full" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="kode_pos" class="block text-sm font-medium text-gray-600">Kode POS</label>
                    <input type="number" name="kode_pos" id="kode_pos" class="mt-1 p-2 border rounded w-full" required />
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Tambah alamat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            //ini ketika provinsi tujuan di klik maka akan eksekusi per intah yg kita mau
            //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
            $('select[name="province_id"]').on('change', function() {
                var selectedProvinceName = $(this).find(':selected').text();
                $('#nama_province').val(selectedProvinceName);
                $('select[name="city_id"]').prop('disabled', true).html(
                    '<option value="">Loading...</option>');
                // kita buat variable provincedid untk menampung data id select province
                let provinceid = $(this).val();
                //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
                if (provinceid) {
                    // jika di temukan id nya kita buat eksekusi ajax GET
                    jQuery.ajax({
                        // url yg di root yang kita buat tadi
                        url: "/get-city/" + provinceid,
                        // aksion GET, karena kita mau mengambil data
                        type: 'GET',
                        // type data json
                        dataType: 'json',
                        // jika data berhasil di dapat maka kita mau apain nih
                        success: function(data) {
                            $('select[name="city_id"]').prop('disabled', false);
                            // jika tidak ada select dr provinsi maka select kota kososng / empty
                            $('select[name="city_id"]').empty();
                            // jika ada kita looping dengan each
                            $.each(data, function(key, value) {
                                // perhtikan dimana kita akan menampilkan data select nya, di sini saya memberi name select kota adalah kota_id
                                $('select[name="city_id"]').append('<option value="' +
                                    value.city_id + '" data-namakota="' + value
                                    .type +
                                    ' ' + value.city_name + '">' + value.type +
                                    ' ' + value.city_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty();
                }
            });
            $('select[name="city_id"]').on('change', function() {
                // Update the hidden input with the selected city name
                var selectedCityName = $(this).find(':selected').text();
                $('#nama_city').val(selectedCityName);
            });
        });
    </script>
@endsection
