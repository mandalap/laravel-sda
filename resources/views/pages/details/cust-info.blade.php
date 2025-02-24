@extends('layouts.app')

@section('title')
@endsection

@push('prepend-style')
@endpush
@push('addon-style')
@endpush

@section('content')
<div id="Content-Container"
        class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto bg-white overflow-x-hidden">
        <div id="Background"
            class="absolute top-0 w-full h-[230px] rounded-b-[75px] bg-gradient-to-r from-[#a7006d] to-[#d40065]">
        </div>
        <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
            <a href="{{ route('detailstanahkavling', $project->slug) }}"
                class="flex items-center justify-center w-10 h-10 overflow-hidden bg-white rounded-full shrink-0">
                <img src="{{ asset('new/assets/images/icons/arrow-left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
            </a>
            <p class="font-semibold text-white">Informasi Pelanggan</p>
            <div class="w-10 dummy-btn"></div>
        </div>
        @php
        // Menghitung jumlah produk tersedia untuk proyek saat ini
            $jumlahProdukTersedia = $project->project_product()->where('status', 'Tersedia')->count();
        @endphp
        <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
            <div class="flex flex-col w-full rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white">
                <div class="flex gap-4">
                    <div class="flex w-[120px] h-[132px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" class="object-cover w-full h-full" alt="icon">
                    </div>
                    <div class="flex flex-col w-full gap-3">
                        <p class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">
                            {{ $project->nama_project }}
                        </p>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $project->lokasi->regency->name }}</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">Tersedia - {{ $jumlahProdukTersedia }} Properti</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <form action="{{ route('checkout', $project->slug) }}" class="relative flex flex-col gap-6 mt-5 pt-5 bg-[#F5F6F8]">
            <div class="flex flex-col gap-[6px] px-5">
                <h1 class="text-lg font-semibold">Informasi Data Pelanggan </h1>
                <p class="text-sm text-ngekos-grey">Isi kolom di bawah ini dengan data Anda yang valid</p>
            </div>
            <div id="InputContainer" class="flex flex-col gap-[18px]">
                <div class="flex flex-col w-full gap-2 px-5">
                    <p class="font-semibold">Nama Lengkap</p>
                    <label
                        class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white focus-within:ring-1 focus-within:ring-[#d40065] transition-all duration-300">
                        <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                        <input type="text" name=""
                            class="w-full font-semibold outline-none appearance-none placeholder:text-ngekos-grey placeholder:font-normal"
                            placeholder="Masukkan Nama Lengkap" required>
                    </label>
                </div>
                <div class="flex flex-col w-full gap-2 px-5">
                    <p class="font-semibold">Email</p>
                    <label
                        class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white focus-within:ring-1 focus-within:ring-[#d40065] transition-all duration-300">
                        <img src="{{ asset('new/assets/images/icons/sms.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                        <input type="email" name="" id=""
                            class="w-full font-semibold outline-none appearance-none placeholder:text-ngekos-grey placeholder:font-normal"
                            placeholder="Masukkan Email">
                    </label>
                </div>
                <div class="flex flex-col w-full gap-2 px-5">
                    <p class="font-semibold">Telepon</p>
                    <label
                        class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white focus-within:ring-1 focus-within:ring-[#d40065] transition-all duration-300">
                        <img src="{{ asset('new/assets/images/icons/call.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                        <input type="number" name=""
                            class="w-full font-semibold outline-none appearance-none placeholder:text-ngekos-grey placeholder:font-normal"
                            placeholder="Masukkan Nomor Telepon" required>
                    </label>
                </div>

                <div class="flex flex-col gap-2">
                    <p class="px-5 font-semibold">Pilih Properti</p>
                    <div class="w-full overflow-x-hidden swiper">
                        <div class="swiper-wrapper">
                            @forelse ( $products as $product )
                            <div class="swiper-slide !w-fit">
                                <label
                                    class="relative flex flex-col items-center justify-center w-fit rounded-3xl p-[14px_20px] gap-3 bg-white border border-white hover:border-[#d40065] has-[:checked]:ring-2 has-[:checked]:ring-[#d40065] transition-all duration-300">
                                    <img src="{{ asset('new/assets/images/icons/calendar.svg') }}" class="w-8 h-8" alt="icon">
                                    <p class="font-semibold text-nowrap">{{ $product->nama_product }}</p>
                                    <input type="radio" name="product" class="absolute opacity-0 top-1/2 left-1/2 -z-10" value="{{ $product->slug }}" required>
                                </label>
                            </div>
                            @empty
                                <p class="px-5 font-semibold">Tidak ada properti tersedia</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

            <div id="BottomNav" class="relative flex w-full h-[132px] shrink-0 bg-white">
                <div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
                    <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-gradient-to-r from-[#a7006d] to-[#d40065]">
                        <div class="flex flex-col gap-[2px]">
                            <p id="price" class="font-bold text-xl leading-[30px] text-white">
                                <!-- price dari js -->
                            </p>
                            <span class="text-sm text-white">Total Booking</span>
                            <p class="font-bold text-xl leading-[30px] text-white">
                                Rp 100.000
                            </p>
                        </div>
                        <button type="submit"
                            class="flex shrink-0 rounded-full py-[14px] px-5 bg-white hover:bg-black hover:text-white font-bold text-black">
                            Booking Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
@endpush
