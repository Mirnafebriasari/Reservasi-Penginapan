<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Penginapan Puncak Sari')</title>

    {{-- CSS --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 text-gray-800">

    {{-- HEADER / NAVBAR Modern --}}
    <header class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-amber-900/95 via-orange-900/95 to-yellow-900/95 backdrop-blur-md shadow-lg border-b border-amber-700/20">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                
                {{-- Logo / Judul --}}
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-xl text-white group-hover:text-yellow-200 transition-colors duration-300">
                            Penginapan Puncak Sari
                        </span>
                        <p class="text-xs text-amber-200 hidden sm:block">Tempat Istirahat Terbaik</p>
                    </div>
                </a>

                {{-- Menu --}}
                <nav class="flex items-center space-x-2">

                    @guest
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 text-white hover:bg-white/10 rounded-lg transition-all duration-300 font-medium">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-5 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-yellow-600 hover:to-orange-600 transition-all duration-300 font-medium shadow-lg hover:shadow-xl">
                            Daftar
                        </a>
                    @endguest

                    @auth
                        {{-- User Profile Dropdown --}}
                        <div class="relative group">
                            <button class="flex items-center space-x-3 px-4 py-2 bg-white/10 rounded-lg hover:bg-white/20 transition-all duration-300">
                                <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-md">
                                    <span class="text-sm font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="font-semibold text-white hidden md:block">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-white group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-gray-100 overflow-hidden">
                                <div class="p-4 bg-gradient-to-r from-amber-600 to-orange-600 border-b border-gray-200">
                                    <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-amber-100">{{ auth()->user()->email }}</p>
                                </div>
                                
                                <div class="p-2">
                                    @if(auth()->user()->hasRole('admin'))
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-amber-50 rounded-lg transition-colors duration-200 text-gray-700">
                                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            <span class="font-medium">Dashboard Admin</span>
                                        </a>
                                    @else
                                        <a href="{{ route('users.dashboard') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-amber-50 rounded-lg transition-colors duration-200 text-gray-700">
                                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <span class="font-medium">Dashboard</span>
                                        </a>
                                    @endif

                                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-amber-50 rounded-lg transition-colors duration-200 text-gray-700">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium">Profil Saya</span>
                                    </a>
                                </div>

                                <div class="p-2 border-t border-gray-100">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2 hover:bg-red-50 rounded-lg transition-colors duration-200 text-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span class="font-medium">Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth

                </nav>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="relative pt-20">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-r from-amber-900 via-orange-900 to-yellow-900 text-white mt-16">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- About --}}
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span>Penginapan Puncak Sari</span>
                    </h3>
                    <p class="text-amber-200 text-sm leading-relaxed">
                        Tempat istirahat terbaik dengan suasana nyaman dan pemandangan indah. Nikmati pengalaman menginap yang tak terlupakan bersama kami.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-xl font-bold mb-4">Menu Cepat</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ url('/') }}" class="text-amber-200 hover:text-yellow-300 transition-colors duration-200 flex items-center space-x-2">
                                <span>→</span>
                                <span>Beranda</span>
                            </a>
                        </li>
                        @auth
                                    @if(auth()->user()->hasRole('admin'))
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="text-amber-200 hover:text-yellow-300 transition-colors duration-200 flex items-center space-x-2">
                                        <span>→</span>
                                        <span>Dashboard Admin</span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('users.dashboard') }}" class="text-amber-200 hover:text-yellow-300 transition-colors duration-200 flex items-center space-x-2">
                                        <span>→</span>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                    <ul class="space-y-3 text-amber-200 text-sm">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jl. Puncak Sari No. 123, Puncak, Bogor</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@puncaksari.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-amber-800 mt-8 pt-8 text-center">
                <p class="text-amber-300 text-sm">
                    &copy; {{ date('Y') }} Penginapan Puncak Sari. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>