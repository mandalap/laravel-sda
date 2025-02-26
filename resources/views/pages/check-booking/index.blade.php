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
            class="absolute top-0 w-full h-[430px] rounded-b-[75px] bg-gradient-to-t from-[#a7006d] to-[#d40065]">
        </div>
        <div class="relative flex flex-col gap-[30px] my-[30px] px-5">
            <h1 class="font-bold text-[30px] leading-[45px] text-center text-white">Periksa<br>Detail Booking</h1>
            <form action="booking-details.html"
                class="flex flex-col rounded-[30px] border border-[#F1F2F6] p-5 gap-6 bg-white">
                <div class="flex flex-col gap-[6px]">
                    <h1 class="text-lg font-semibold">Data Informasi</h1>
                    <p class="text-sm text-ngekos-grey">Isi kolom di bawah ini dengan data Anda yang valid</p>
                </div>
                <div id="InputContainer" class="flex flex-col gap-[18px]">
                    <div class="flex flex-col gap-2 w-full">
                        <p class="font-semibold">Booking ID</p>
                        <label
                            class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#d40065] transition-all duration-300">
                            <img src="{{ asset('new/assets/images/icons/note-favorite-grey.svg') }}" class="flex w-5 h-5 shrink-0"
                                alt="icon">
                            <input type="text" name="" id=""
                                class="w-full font-semibold appearance-none outline-none placeholder:text-ngekos-grey placeholder:font-normal"
                                placeholder="Masukkan Booking ID">
                        </label>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class="font-semibold">Nomor Telepon</p>
                        <label
                            class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#d40065] transition-all duration-300">
                            <img src="{{ asset('new/assets/images/icons/call.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                            <input type="tel" name="" id=""
                                class="w-full font-semibold appearance-none outline-none placeholder:text-ngekos-grey placeholder:font-normal"
                                placeholder="Masukkan Nomor Telepon">
                        </label>
                    </div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-full p-[14px_20px] bg-[#d40065] font-bold text-white hover:bg-black hover:text-white">Lihat Booking Kamu</button>
                </div>
            </form>
        </div>

        @include('includes.footer')
    </div>
@endsection


