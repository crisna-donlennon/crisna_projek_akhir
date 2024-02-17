@extends('layouts.base')

@section('container')
    <div class="container mx-auto my-8">
        <div class="bg-white container mx-auto my-8 p-8 rounded-md shadow-md w-2/3 flex flex-col border-[1px]">    
            <h2 class="text-2xl font-semibold mb-6">
                Tambah Alamat
            </h2>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('alamat.store') }}">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label for="provinsi" class="block font-medium text-gray-700 mb-1">
                        Provinsi Tujuan
                    </label>
                    <select name="province_id" id="province_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value=""></option>
                        @foreach ($provinsi as $row)
                            <option value="{{ $row['province_id'] }}" data-namaprovinsi="{{ $row['province'] }}">
                                {{ $row['province'] }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="nama_province" id="nama_province" value="">
                </div>
                <div class="mb-4 ">
                    <label class="block font-medium text-gray-700 mb-1">
                        Kota Tujuan*
                    </label>
                    <select name="city_id" id="kota_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value=""></option>
                    </select>
                    <input type="hidden" name="nama_city" id="nama_city" value="">
                </div>
                <div class="mb-4">
                    <label for="alamat_detail" class="block font-medium text-gray-700 mb-1">
                        Alamat Detail
                    </label>
                    <label for="name" class="block text-xs text-gray-600">
                        (isi alamat dengan format lengkap: alamat rumah, kecamatan)
                    </label>    
                    <textarea placeholder="Contoh: Jl. Pemuda Blok A No. 12, Bubutan" type="text" name="alamat_detail" id="alamat_detail" class="mt-1 p-2 border rounded w-full" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="kode_pos" class="block font-medium text-gray-700 mb-1">
                        Kode POS
                    </label>
                    <input type="number" name="kode_pos" id="kode_pos" class="mt-1 p-2 border rounded w-full" required />
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-full py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                        Tambahkan Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('select[name="province_id"]').on('change', function() {
                var selectedProvinceName = $(this).find(':selected').text();
                $('#nama_province').val(selectedProvinceName);
                $('select[name="city_id"]').prop('disabled', true).html(
                    '<option value="">Loading...</option>');
                let provinceid = $(this).val();
                if (provinceid) {
                    jQuery.ajax({
                        url: "/get-city/" + provinceid,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="city_id"]').prop('disabled', false);
                            $('select[name="city_id"]').empty();
                            $.each(data, function(key, value) {
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
                var selectedCityName = $(this).find(':selected').text();
                $('#nama_city').val(selectedCityName);
            });
        });
    </script>
@endsection
