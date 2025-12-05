@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 to-yellow-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        {{-- Card Container --}}
        <div class="bg-white rounded-2xl shadow-xl p-8">
            {{-- Header --}}
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    {{ __('Welcome Back') }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Log in to your account') }}
                </p>
            </div>

            {{-- Session Status Alert --}}
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm font-medium text-green-800">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- Pesan error umum login (kredensial salah dll) --}}
            @if ($errors->has('email') && !$errors->has('password'))
                {{-- Kalau hanya error di email, kemungkinan ini error validasi --}}
            @elseif ($errors->has('email') || $errors->has('password'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-r-lg text-red-700">
                    <p class="font-semibold">Email atau password salah.</p>
                </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Email') }}
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                        class="w-full px-4 py-3 border @error('email') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent transition duration-200 ease-in-out @error('email') bg-red-50 @endif"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Password') }}
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-3 border @error('password') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent transition duration-200 ease-in-out @error('password') bg-red-50 @endif"
                        placeholder="Masukkan password Anda"
                    >
                    @error('password')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit"
                    class="w-full bg-amber-700 text-white font-semibold py-3 px-4 rounded-lg hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2 transform transition duration-150 ease-in-out hover:scale-[1.02] active:scale-[0.98]"
                >
                    {{ __('Log in') }}
                </button>

                {{-- Register Link --}}
                @if (Route::has('register'))
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}" class="font-medium text-amber-700 hover:text-amber-800 transition duration-150">
                                {{ __('Sign up') }}
                            </a>
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
