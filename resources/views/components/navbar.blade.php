<div class="bg-[#0A2974] text-white fixed top-0 w-full z-50 h-9 text-sm
            xl:bg-red-200 lg:bg-blue-200 md:bg-green-300 sm:bg-yellow-200 min-[320px] max-[640px]:bg-purple-300
              xl: lg: md: sm: min-[320px] max-[640px]:">
    <nav class="px-4 py-2 flex w-full justify-center items-center h-9 shadow-md">
        <div class="space-x-4">
            <a href="/home" class="text-white hover:text-yellow-300 transition duration-300 ease-in-out border-r-[1px] pr-5">BERANDA</a>
            <a href="{{ url('/productmain') }}" class="text-white hover:text-yellow-300 transition duration-300 ease-in-out border-r-[1px] pr-5">PRODUK</a>
            {{-- <a href="{{ url('/home#about') }}" class="text-white hover:text-yellow-300 transition duration-300 ease-in-out border-r-[1px] pr-5">TENTANG KAMI</a> --}}
            <a href="{{ url('/home#tutorial') }}" class="text-white hover:text-yellow-300 transition duration-300 ease-in-out pr-3">CARA PESAN</a>
        </div>
    </nav>
</div>