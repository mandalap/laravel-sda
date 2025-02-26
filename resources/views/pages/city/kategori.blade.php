@extends('layouts.app')

@section('title')
@endsection

@push('prepend-style')
@endpush
@push('addon-style')
@endpush

@section('content')

<div id="Background" class="absolute top-0 w-full h-[100px] rounded-bl-[30px] rounded-br-[30px] bg-gradient-to-r from-[#a7006d] to-[#d40065]"></div>
    <div id="Top-nav" class="flex relative justify-between items-center px-4 pt-5">
        <a href="{{ route('beranda') }}">
            <div class="flex w-10 h-10 shrink-0">
                <img src="{{ asset('new/assets/images/icons/back.svg') }}" alt="icon">
            </div>
        </a>
        <div class="flex flex-col text-center w-fit">
            <h1 class="font-semibold text-lg leading-[27px] text-white">{{ $kategori->kategori }}</h1>
            <p class="text-sm leading-[21px] text-[#909DBF] text-white">{{ $cities->count() }} Kota Ditemukan</p>
        </div>
        <button class="flex w-10 h-10 shrink-0">
            <img src="{{ asset('new/assets/images/icons/filter.svg') }}" alt="icon">
        </button>
    </div>
        <section id="Store-list" class="flex flex-col gap-6 px-4 mt-[60px]">
            @php
                // Menghitung jumlah produk tersedia untuk setiap kota
                $citiesWithProductCount = $cities->map(function ($city) {
                    $jumlahProdukTersedia = $city->project->flatMap(function ($project) {
                        return $project->project_product()->where('status', 'Tersedia')->get();
                    })->count();

                    // Menambahkan jumlah produk tersedia ke objek kota
                    $city->jumlah_produk_tersedia = $jumlahProdukTersedia;

                    return $city;
                });

                // Mengurutkan kota berdasarkan jumlah produk tersedia (descending)
                $sortedCities = $citiesWithProductCount->sortByDesc('jumlah_produk_tersedia');
            @endphp

            @forelse ($sortedCities as $city)
                <a href="{{ route('detailkategori', [$kategori->slug, $city->slug]) }}" class="card">
                    <div class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#d40065]">
                        <div class="w-full h-[120px] flex shrink-0 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $city->thumbnail) }}" class="object-cover w-full h-full" alt="thumbnail">
                            @if ($city->jumlah_produk_tersedia == 0)
                                <p class="rounded-full p-[6px_10px] bg-[#F12B3E] w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                                    Habis
                                </p>
                            @else
                                <p class="rounded-full p-[6px_10px] bg-[#058E2A] w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                                    Tersedia
                                </p>
                            @endif
                        </div>
                        <div class="flex gap-4 justify-between items-center px-4">
                            <div class="title flex flex-col gap-[6px]">
                                <div class="flex gap-1 items-center">
                                    <h1 class="font-semibold w-fit">{{ $city->regency->name }}</h1>
                                </div>
                                <div class="flex items-center gap-[2px]">
                                    <div class="flex w-4 h-4 shrink-0">
                                        <img src="{{ asset('new/assets/images/icons/location.svg') }}" alt="icon">
                                    </div>
                                    <p class="text-sm leading-[21px] text-[#909DBF]">{{ $city->province->name }}</p>
                                </div>
                            </div>
                            <div class="rating flex flex-col gap-[6px]">
                                <div class="flex items-center justify-end text-right gap-[6px]">
                                    <h1 class="font-semibold w-fit">
                                        {{ $city->project->count() }} Project
                                    </h1>
                                </div>
                                <div class="flex items-center justify-end text-right gap-[2px]">
                                    <p class="text-sm leading-[21px] text-[#909DBF]">
                                        {{ $city->jumlah_produk_tersedia }} Properti
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center">Data belum tersedia</p>
            @endforelse
        </section>

        @include('includes.footer')
@endsection

@push('addon-script')

@endpush
