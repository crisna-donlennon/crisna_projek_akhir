@extends('dashboard.main')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="user-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 shadow-lg border-b border-gray-300">
            <tr>
                <th scope="col" class="px-4 py-2">
                    Nama
                </th>
                <th scope="col" class="px-4 py-2">
                    Email
                </th>
                <th scope="col" class="px-4 py-2">
                    Nomor HP
                </th>
                <th scope="col" class="px-4 py-2">
                    Roles
                </th>
                <th scope="col" class="py-2 flex justify-center">
                    Hapus User
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $user )
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-100">
                    {{ $user->name }}
                </th>
                <td class="px-4 py-2 bg-gray-100">
                    {{ $user->email }}
                </td>
                <td class="px-4 py-2 bg-gray-100">
                    {{ $user->nomor_hp }}
                </td>
                <!-- Inside the foreach loop in your Blade file -->
                @if(auth()->user()->roles === 'pemilik')
                    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @method('patch') <!-- Assuming you want to use PATCH method for updating -->
        
                        <td class="px-4 py-2 bg-gray-100">
                            @if($user->id !== auth()->user()->id && $user->roles !== 'pemilik')
                                <select name="roles" onchange="this.form.submit()">
                                    <option value="pengguna" {{ $user->roles === 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                                    <option value="admin" {{ $user->roles === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            @else
                                {{ $user->roles }}
                            @endif
                        </td>
                    </form>
                @elseif($user->roles === 'pemilik')
                    <td class="px-4 py-2 bg-gray-100">
                        {{ $user->roles }}
                    </td>
                @else
                    <td class="px-4 py-2 bg-gray-100">
                        {{ $user->roles }}
                    </td>
                @endif
    
                <td class="px-4 py-2 justify-center flex items-center bg-gray-100">
                    @auth
                        @if(auth()->user()->roles === 'pemilik')
                            <button class="flex text-center items-center justify-center align-middle w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125 " onclick="showDeleteConfirmation('{{ $user->id }}')">
                                <svg class="flex w-5 h-5 pl-[1px] text-white opacity-90 justify-end items-center align-middle text-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                            </button>
                        @endif
                    @endauth
                </td>
                
                <!-- Custom Delete Confirmation Modal -->
                <div id="deleteConfirmation{{ $user->id }}" class="fixed inset-0 z-50 hidden justify-center items-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white p-6 rounded-md w-96">
                        <p class="text-xl font-bold mb-4">Konfirmasi Hapus User</p>
                        <p class="mb-4">Hapus user ini? Apakah Anda yakin?</p>
                        <form id="deleteUserForm{{ $user->id }}" action="{{ url('/dashboard/user/'.$user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-4 py-2 mr-2">Ya</button>
                            <button type="button" onclick="hideDeleteConfirmation('{{ $user->id }}')" class="bg-gray-300 text-gray-700 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2">Tidak</button>
                         </form>
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
            "order": [[0, 1, 3, 4, "asc"]], // Sort by the third column (Type) in ascending order
            "columnDefs": [
                { "orderable": false, "targets": [2, 5] } // Disable sorting for other columns
            ]
        });
    });
</script>

@endsection
