<x-guest-layout>

    <div class="pt-32">
        <h1 class="font-bold text-white text-4xl">Hai {{ Auth::user()->name }}</h1>
        <h3 class="mt-2 text-white text-xl">Selamat datang kembali</h3>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-citragreen-100 text-lg">log out</button>
        </form>

        <div class="mt-16">
            <h3 class="text-white text-xl">Pilih UMKM atau perusahaan yang kamu miliki.</h3>
            <div class="mt-4 flex flex-wrap gap-5">
                @foreach ($umkms as $umkm)
                    <form method="POST" action="{{ route('umkm.save_umkm') }}">
                        @csrf
                        <input type="hidden" value="{{ $umkm->id }}" name="umkm_id" id="">
                        <button type="submit"
                            class="w-44 h-44 flex justify-center items-center shadow-md rounded-lg bg-white p-5">
                            <div>
                                <img src="{{ asset('images/assets/shop.svg') }}" class="w-28" alt="">
                                <h2 class="text-lg font-bold text-center mt-2">
                                    {{ $umkm->name }}
                                </h2>
                            </div>
                        </button>
                    </form>
                @endforeach
                @if ($umkms->count() < 1)
                    <a href="{{ route('umkm.create') }}"
                        class="w-44 h-44 flex justify-center items-center shadow-md rounded-lg bg-white p-5">
                        <div class="flex flex-col items-center">
                            <i class="bx bx-plus text-8xl"></i>
                            <h2 class="text-lg font-bold text-center">
                                Tambah UMKM
                            </h2>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

</x-guest-layout>
