<div class="bg-slate-300 text-white pt-14 pb-5 w-full z-50 border-b-2 border-gray-400 flex justify-end items-center space-x-4 px-4">
    @auth
        <button
            class="bg-red-600 group hover:bg-blue-600 text-black px-4 my-1 hover:rounded-t hover:rounded-b-none rounded relative border-black shadow-inner">
            {{ Auth::user()->name }}
            <div class="absolute right-0 top-6 w-full ">
                <div class="hidden group-hover:flex hover:flex w-full flex-col bg-white drop-shadow-lg">
                    <a class="bg-[rgb(233,233,237)] px-5 py-2 hover:bg-gray-300 text-black text-sm" href="/logout">Logout</a>
                </div>
                @if (Auth::user()->roles == 'admin')
                    <div class="hidden group-hover:flex hover:flex w-full flex-col bg-white drop-shadow-lg">
                        <a class="bg-[rgb(233,233,237)] px-5 py-2 hover:bg-gray-300 text-black text-sm"
                            href="/dashboard">Dashboard</a>
                    </div>
                @endif
            </div>
        </button>
        <a href="/cart" class="text-black hover:text-gray-500 transition duration-300 ease-in-out">CART</a>
        <a href="/order/pesanan-pending" class="text-black hover:text-gray-500 transition duration-300 ease-in-out">PESANANAN</a>
    @else
        <a href="/login" class="text-black hover:text-gray-500 transition duration-300 ease-in-out pr-5">LOGIN</a>
        <a href="/adminregistration"
            class="text-black hover:text-gray-500 transition duration-300 ease-in-out pr-5">REGISTER</a>
    @endauth
</div>
