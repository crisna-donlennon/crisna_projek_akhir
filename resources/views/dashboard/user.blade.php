@extends('dashboard.main')

@section('header')
<div class="">
    <p class="text-lg flex w-full font-semibold">
        USERS
    </p>
</div>
@endsection

@section('content')
<div class="relative overflow-x-auto">
    <table id="user-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 border-b border-gray-300">
            <tr>
                <th scope="col" class="px-4 py-2">
                    NAMA
                </th>
                <th scope="col" class="px-4 py-2">
                    EMAIL
                </th>
                <th scope="col" class="px-4 py-2">
                    NOMOR HP
                </th>
                <th scope="col" class="px-4 py-2">
                    ROLES
                </th>
                <th scope="col" class="py-2 flex justify-center">
                    HAPUS USER
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $user )
            <tr class="odd:bg-slate-50 odd:dark:bg-gray-900 even:bg-slate-100 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->name }}
                </th>
                <td class="px-4 py-2">
                    {{ $user->email }}
                </td>
                <td class="px-4 py-2">
                    {{ $user->nomor_hp }}
                </td>
                @if(auth()->user()->roles === 'pemilik')
                    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @method('patch')
                        <td class="px-4 py-2">
                            @if($user->id !== auth()->user()->id && $user->roles !== 'pemilik')
                                <select name="roles" onchange="this.form.submit()" class="cursor-pointer">
                                    <option value="pengguna" {{ $user->roles === 'pengguna' ? 'selected' : '' }}>
                                        Pengguna
                                    </option>
                                    <option value="admin" {{ $user->roles === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>
                            @else
                                {{ $user->roles }}
                            @endif
                        </td>
                    </form>
                @elseif($user->roles === 'pemilik')
                    <td class="px-4 py-2">
                        {{ $user->roles }}
                    </td>
                @else
                    <td class="px-4 py-2">
                        {{ $user->roles }}
                    </td>
                @endif
                <td class="px-4 py-2 justify-center flex items-center">
                    @auth
                        @if(auth()->user()->roles === 'pemilik')
                            <button class="w-fit px-3 h-[30px] flex cursor-pointer items-center font-medium hover:brightness-95 uppercase rounded-md hover:text-red-600 " onclick="showDeleteConfirmation('{{ $user->id }}')">
                                HAPUS USER
                            </button>
                        @endif
                    @endauth
                </td>
                


                {{-- CLICK VIEW --}}
                <div id="deleteConfirmation{{ $user->id }}" class="hidden bg-[rgba(0,0,0,0.5)] min-h-screen overflow-y-auto bg-overflow-x-hidden fixed z-50 justify-center items-center w-full md:inset-0 py-10">
                    <div class="bg-white p-6 rounded-md w-96">
                        <p class="text-xl font-bold mb-4">
                            Konfirmasi Hapus User
                        </p>
                        <p class="mb-4">
                            Apakah yakin ingin menghapus User ini?
                        </p>
                        <div class="flex justify-end gap-4">
                            <form id="deleteUserForm{{ $user->id }}" action="{{ url('/dashboard/user/'.$user->id) }}" method="POST" class="flex justify-end">
                                @csrf
                                @method('delete')
                                <button type="submit" class="bg-gray-100 hover:text-red-600 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-fit px-3 py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                                    YA
                                </button>
                                <button type="button" onclick="hideDeleteConfirmation('{{ $user->id }}')" class="bg-gray-100 active:scale-95 transition duration-300 ease-in-out border-[1px] rounded-md w-fit px-3 py-1 mt-2 hover:brightness-95 justify-center flex items-center text-lg font-bold">
                                    TIDAK
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function showDeleteConfirmation(userId) {
        var modal = document.getElementById('deleteConfirmation' + userId);
        modal.style.display = 'flex';
    }

    function hideDeleteConfirmation(userId) {
        var modal = document.getElementById('deleteConfirmation' + userId);
        modal.style.display = 'none';
    }




    // Initialize DataTables
    $(document).ready( function () {
        $('#user-table').DataTable({
            "order": [[0, 1, 2, 3, "asc"]], // Sort by the third column (Type) in ascending order
            "columnDefs": [
                { "orderable": false, "targets": [4] } // Disable sorting for other columns
            ]
        });
    });
</script>

@endsection
