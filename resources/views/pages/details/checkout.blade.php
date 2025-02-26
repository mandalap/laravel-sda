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
        <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[30px]">
            <a href=""
                class="flex overflow-hidden justify-center items-center w-10 h-10 bg-white rounded-full shrink-0">
                <img src="{{ asset('new/assets/images/icons/arrow-left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
            </a>
            <p class="font-semibold text-white">Checkout</p>
            <div class="w-12 dummy-btn"></div>
        </div>
        <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
            <div class="flex flex-col w-full rounded-[30px] border border-[#F1F2F6] p-2 gap-4 bg-white">
                <div class="flex gap-4">
                    <div class="flex w-[120px] h-[132px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" class="object-cover w-full h-full" alt="icon">
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <p class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">
                            {{ $project->nama_project }}
                        </p>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $project->lokasi->regency->name }}</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('new/assets/images/icons/3dcube.svg') }}" class="flex w-5 h-5 shrink-0"
                                alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $project->kategori->kategori }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="accordion group flex flex-col rounded-[30px] p-5 bg-[#F5F6F8] mx-5 mt-5 overflow-hidden has-[:checked]:!h-[68px] transition-all duration-300">
            <label class="flex relative justify-between items-center">
                <p class="text-lg font-semibold">Pelanggan</p>
                <img src="{{ asset('new/assets/images/icons/arrow-up.svg') }}"
                    class="w-[28px] h-[28px] flex shrink-0 group-has-[:checked]:rotate-180 transition-all duration-300"
                    alt="icon">
                <input type="checkbox" class="hidden absolute">
            </label>
            <div class="flex flex-col gap-4 pt-[22px]">
                <div class="flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-6 h-6 shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Nama</p>
                    </div>
                    <p class="font-semibold">{{ $nama }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('new/assets/images/icons/sms.svg') }}" class="flex w-6 h-6 shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Email</p>
                    </div>
                    <p class="font-semibold">{{ $email }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('new/assets/images/icons/call.svg') }}" class="flex w-6 h-6 shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Telepon</p>
                    </div>
                    <p class="font-semibold">{{ $telepon }}</p>
                </div>
            </div>
        </div>
        <div
            class="accordion group flex flex-col rounded-[30px] p-5 bg-[#F5F6F8] mx-5 mt-5 overflow-hidden has-[:checked]:!h-[68px] transition-all duration-300">
            <label class="flex relative justify-between items-center">
                <p class="text-lg font-semibold">Booking</p>
                <img src="{{ asset('new/assets/images/icons/arrow-up.svg') }}"
                    class="w-[28px] h-[28px] flex shrink-0 group-has-[:checked]:rotate-180 transition-all duration-300"
                    alt="icon">
                <input type="checkbox" class="hidden absolute">
            </label>
            <div class="flex flex-col gap-4 pt-[22px]">
                <div class="flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('new/assets/images/icons/clock.svg') }}" class="flex w-6 h-6 shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Nomor Properti</p>
                    </div>
                    <p class="font-semibold">{{ $product->nama_product }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('new/assets/images/icons/calendar.svg') }}" class="flex w-6 h-6 shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Tanggal</p>
                    </div>
                    <p class="font-semibold">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>
        <form action="success-booking.html" class="flex relative flex-col gap-6 pt-5 mt-5">
            <div id="PaymentOptions" class="flex flex-col rounded-[30px] border border-[#F1F2F6] p-5 gap-4 mx-5">
                <div id="TabButton-Container"
                    class="flex items-center justify-between border-b border-[#F1F2F6] gap-[18px]">
                    <label class="flex relative flex-col gap-4 justify-between tab-link group"
                        data-target-tab="#DownPayment-Tab">
                        <input type="radio" name="Payment" value="down"
                            class="absolute top-1/2 left-1/2 opacity-0 -z-10" checked>
                        <div class="flex gap-3 items-center mx-auto">
                            <div class="relative w-6 h-6">
                                <img src="{{ asset('new/assets/images/icons/status-orange.svg') }}"
                                    class="absolute w-6 h-6 flex shrink-0 opacity-0 group-has-[:checked]:opacity-100 transition-all duration-300"
                                    alt="icon">
                                <img src="{{ asset('new/assets/images/icons/status.svg') }}"
                                    class="absolute w-6 h-6 flex shrink-0 opacity-100 group-has-[:checked]:opacity-0 transition-all duration-300"
                                    alt="icon">
                            </div>
                            <p class="font-semibold">Pembayaran</p>
                        </div>
                        <div
                            class="w-0 mx-auto group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#058E2A] group-has-[:checked]:w-[90%] transition-all duration-300">
                        </div>
                    </label>
                </div>
                <div id="TabContent-Container">
                    <div id="DownPayment-Tab" class="flex flex-col gap-4 tab-content">
                        <p class="text-sm text-ngekos-grey">Anda perlu melunasi pembayaran secara cash setelah melakukan
                            survey lokasi</p>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-3 items-center">
                                <img src="{{ asset('new/assets/images/icons/card-tick.svg') }}"
                                    class="flex w-6 h-6 shrink-0" alt="icon">
                                <p class="text-ngekos-grey">Jumlah Pembayaran</p>
                            </div>
                            <p class="font-semibold">Rp 100.000</p>
                        </div>
                    </div>

                </div>
            </div>
            <div id="BottomNav" class="relative flex w-full h-[132px] shrink-0">
                <div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
                    <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-gradient-to-r from-[#a7006d] to-[#d40065]">
                        <div class="flex flex-col gap-[2px]">
                            <p id="price" class="text-sm leading-[30px] text-white">
                            </p>
                            <span class="text-sm text-white">Total Booking</span>
                            <p class="font-bold text-lg leading-[30px] text-white">
                                Rp 100.000
                            </p>
                        </div>
                        <button type="submit"
                            class="flex shrink-0 rounded-full py-[14px] px-5  bg-white   hover:bg-black hover:text-white font-bold text-black">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
@endpush
