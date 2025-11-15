<x-guest-layout>
    <div class="min-h-screen bg-white dark:bg-slate-900">
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
            <div class="hidden lg:flex items-center justify-center p-8 bg-white dark:bg-slate-800">
                <div class="w-full h-full max-w-4xl max-h-[90vh] flex items-center justify-center">
                    <lottie-player
                    src="{{ asset('public/lottie/register-animation.json') }}"
                    background="transparent"
                    speed="1"
                    loop
                    autoplay
                    style="width:100%;height:100%;max-height:90vh;"
                    ></lottie-player>
                </div>
            </div>  

            <div class="flex items-center justify-center p-6 md:p-12 bg-slate-50 dark:bg-slate-900">
                <div class="w-full max-w-md">
                    <div class="text-center lg:text-left mb-6">
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Create a new account</h1>
                        <p class="text-slate-600 dark:text-slate-400">Fill your details to get started with HR Portal.</p>
                    </div>

                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6 md:p-8 border border-slate-200 dark:border-slate-700">
                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                                <x-text-input
                                    id="name"
                                    class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-slate-900 dark:text-white rounded-lg px-4 py-3 outline-none focus-visible:ring-[3px] focus-visible:ring-emerald-500/30 focus-visible:border-emerald-500 transition"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                                <x-text-input
                                    id="email"
                                    class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-slate-900 dark:text-white rounded-lg px-4 py-3 outline-none focus-visible:ring-[3px] focus-visible:ring-emerald-500/30 focus-visible:border-emerald-500 transition"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autocomplete="username"
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                                <x-text-input
                                    id="password"
                                    class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-slate-900 dark:text-white rounded-lg px-4 py-3 outline-none focus-visible:ring-[3px] focus-visible:ring-emerald-500/30 focus-visible:border-emerald-500 transition"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                                <x-text-input
                                    id="password_confirmation"
                                    class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-slate-900 dark:text-white rounded-lg px-4 py-3 outline-none focus-visible:ring-[3px] focus-visible:ring-emerald-500/30 focus-visible:border-emerald-500 transition"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <button type="submit" class="w-full h-11 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-medium shadow-md hover:shadow-lg transition">
                                {{ __('Register') }}
                            </button>

                            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Already registered?') }}
                                <a href="{{ route('login') }}" class="text-emerald-600 hover:underline font-medium">{{ __('Sign in') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-guest-layout>

