@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-bold text-amber-900 mb-1">Kelola User</h1>
            <p class="text-amber-700">Manajemen pengguna sistem</p>
        </div>

        <a href="{{ route('admin.users.create') }}" 
           class="inline-flex items-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Tambah User Baru
        </a>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-8 max-w-md flex rounded-lg overflow-hidden border border-amber-300 shadow-sm gap-2">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama atau email..."
        class="flex-grow px-4 py-2 text-amber-900 placeholder-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500"
    >

    <select name="role" class="px-4 py-2 text-amber-900 border-l border-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
        <option value="">Semua Role</option>
        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
    </select>

    <button
        type="submit"
        class="bg-amber-600 hover:bg-amber-700 text-white px-6 font-semibold transition-colors duration-200"
    >
        Cari
    </button>
</form>



        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-r-lg shadow-md animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-amber-100">
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Nama
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Email
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Role
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-amber-50 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold mr-3 shadow-md">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-amber-900 font-medium">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-amber-800">
                                    <svg class="w-4 h-4 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    // Ambil role dari relasi roles Spatie
                                    $roleName = $user->roles->first()->name ?? 'user';
                                    
                                    // Tentukan warna berdasarkan role
                                    $roleColors = [
                                        'admin' => 'bg-purple-100 text-purple-800 border-purple-300',
                                        'user' => 'bg-blue-100 text-blue-800 border-blue-300',
                                    ];
                                    
                                    $roleColor = $roleColors[$roleName] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                                @endphp
                                
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $roleColor }}">
                                    @if($roleName === 'admin')
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                        </svg>
                                    @elseif($roleName === 'manager')
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($roleName) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="inline-flex items-center bg-amber-500 px-3 py-2 rounded-lg text-white hover:bg-amber-600 transition-colors duration-200 text-sm font-medium shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center bg-red-600 px-3 py-2 rounded-lg text-white hover:bg-red-700 transition-colors duration-200 text-sm font-medium shadow-md">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="text-amber-800 font-medium text-lg">Belum ada user</p>
                                <p class="text-amber-600 mt-1">Tambahkan user baru untuk memulai</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden p-4 space-y-4">
                @forelse($users as $user)
                @php
                    $roleName = $user->roles->first()->name ?? 'user';
                    $roleColors = [
                        'admin' => 'bg-purple-100 text-purple-800 border-purple-300',
                        'user' => 'bg-blue-100 text-blue-800 border-blue-300',
                    ];
                    $roleColor = $roleColors[$roleName] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                @endphp
                
                <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-md border border-amber-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white bg-opacity-30 flex items-center justify-center text-white font-bold mr-3">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="text-white font-semibold">{{ $user->name }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $roleColor }}">
                            {{ ucfirst($roleName) }}
                        </span>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <div class="flex items-center text-amber-800">
                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">{{ $user->email }}</span>
                        </div>

                        <div class="flex gap-2 pt-2 border-t border-amber-100">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="flex-1 inline-flex items-center justify-center bg-amber-500 px-3 py-2 rounded-lg text-white hover:bg-amber-600 transition-colors duration-200 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center bg-red-600 px-3 py-2 rounded-lg text-white hover:bg-red-700 transition-colors duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <p class="text-amber-800 font-medium text-lg">Belum ada user</p>
                    <p class="text-amber-600 mt-1">Tambahkan user baru untuk memulai</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow-md border border-amber-100 px-4 py-3">
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection