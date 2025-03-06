<x-guest-layout>
    <div class="card-custom shadow-lg rounded-lg overflow-hidden">
        <div class="card-body-custom p-8">
            <div class="flex justify-center mb-6">
            </div>
            
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />

                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mb-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow" style="background-color: #2563eb;">
                        {{ __('Log in') }}
                    </button>
                </div>
                
                <div class="text-center mt-6">
                    <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        {{ __('Need an account? Register') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
