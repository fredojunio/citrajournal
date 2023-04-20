<x-guest-layout>
    <div class="flex sm:justify-between min-h-screen">
        <div class="self-center">
            <img src="{{ asset('images/assets/login_money.svg') }}" class="w-56 mb-5" alt="">
            <h1 class="font-bold text-white text-2xl">
                Membuat laporan keuangan <br>
                jadi lebih mudah
            </h1>
        </div>

        <div class="w-full sm:max-w-lg mt-36 px-10 py-10 bg-white shadow-lg overflow-hidden sm:rounded-t-xl">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />


            <h2 class="font-bold mb-4">Log in</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                {{-- <div class="block mt-32">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

                <div class="mt-32">
                    <x-long-primary-button>
                        {{ __('Log in') }}
                    </x-long-primary-button>

                    <div class="flex justify-center">
                        <a href="{{ route('register') }}"
                            class="mt-3 underline text-xs text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Belum
                            memiliki akun? buat disini</a>
                    </div>
                    {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}


                </div>
            </form>
        </div>

    </div>


</x-guest-layout>
