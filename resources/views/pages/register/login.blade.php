@extends('layouts.guest')

@section('title')
    Login
@endsection

@push('prepend-style')
@endpush
@push('addon-style')
@endpush

@section('content')
    <!-- component -->
    <div class="flex justify-center items-center p-4 min-h-screen bg-gray-100">
        <div class="p-8 w-full max-w-md bg-white rounded-xl shadow-lg">
            <img src="{{ asset('new/assets/images/icons/logo.svg') }}" class="mx-auto w-auto h-20" alt="icon">
            <h2 class="mt-4 mb-6 text-2xl font-semibold text-center text-gray-900">Login</h2>
            <form class="space-y-4" method="POST" action="{{ route('store.login') }}">
                @csrf
                <!-- Nomor WhatsApp -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}"
                        class="px-4 py-2 w-full rounded-lg border border-gray-300 transition-all outline-none focus:ring-2 focus:ring-[#058E2A] focus:border-[#058E2A]"
                        placeholder="Masukkan Nomor WhatsApp" required />
                    @error('telepon')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password"
                        class="px-4 py-2 w-full rounded-lg border border-gray-300 transition-all outline-none focus:ring-2 focus:ring-[#058E2A] focus:border-[#058E2A]"
                        placeholder="••••••••" required />
                    @error('password')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <label class="flex items-center">
                        <input type="checkbox" class="text-[#058E2A] rounded border-gray-300 focus:ring-[#058E2A]" />
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                    <a href="{{ route('lupapassword') }}" class="text-sm text-[#058E2A] hover:text-black">Lupa
                        Password?</a>
                </div>

                <button
                    class="py-2.5 w-full font-medium text-white  bg-[#058E2A] hover:bg-green-500  rounded-lg transition-colors">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-sm text-center text-gray-600">
                Belum punya akun?
                <a href="{{ route('daftar') }}" class="font-medium text-[#058E2A] hover:text-black">Daftar</a>
            </div>
        </div>
    </div>

    @include('includes.script')
@endsection

@push('addon-script')
@endpush
