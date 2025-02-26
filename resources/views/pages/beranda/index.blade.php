@extends('layouts.app')

@section('title')
    Beranda
@endsection

@push('prepend-style')
@endpush
@push('addon-style')
@endpush

@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[180px] rounded-bl-[30px] rounded-br-[30px] bg-gradient-to-r from-[#a7006d] to-[#d40065]">
    </div>

    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[30px]">
        <div class="flex flex-col gap-1 text-white">
            <p>Halo Sahabat Investa {{Auth::user()->nama}},</p>
            <h1 class="font-bold text-sm leading-[20px] ">Temukan Property Impian Kamu</h1>
        </div>
        <a href="#" class="flex justify-center items-center w-20 h-20 overflow-hiddenrounded-full shrink-0">
            <img src="{{ asset('new/assets/images/icons/logo.svg') }}" class="w-[60px] h-[60px]" alt="icon">
        </a>
    </div>

    <section id="Promo" class="flex relative z-10 flex-col gap-3 px-4 mt-[20px]">
        <a href="#">
            <div class="w-full aspect-[360/120] flex shrink-0 rounded-[20px] overflow-hidden">
                <img src="{{ asset('new/assets/images/thumbnails/banner.png') }}" class="object-cover w-full h-full"
                    alt="promo banner">
            </div>
        </a>
    </section>

    <section id="height" class="flex flex-col p-2 gap-4 bg-[#F5F6F8] mt-[30px]"></section>

    <div id="Feature" class="px-[18px] relative z-10">
        <div class="bg-white p-[18px_16px] rounded-xl overflow-hidden grid grid-cols-4 gap-[27px]">
            @forelse ( $kategories as $kategori )
            <a href="{{ route('kategori', $kategori->slug) }}">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/location-pin.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">{{ $kategori->kategori }}</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/land.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">Tanah Ruko</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/house.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">Rumah</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/apartments.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">Ruko</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/folder.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">Validasi Berkas</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/farmer.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">Kelola Lahan</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/rent.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center  text-xs text-[#757C98] leading-[21px]">Cari Kontrakkan</p>
                </div>
            </a>
            <a href="list-city.html">
                <div class="flex flex-col gap-2 items-center">
                    <div class="w-[40px] h-[40px] flex shrink-0">
                        <img src="{{ asset('new/assets/images/icons/design.svg') }}" class="object-cover" alt="icon">
                    </div>
                    <p class="font-medium text-center text-xs text-[#757C98] leading-[21px]">Jasa Interior</p>
                </div>
            </a>
        </div>
    </div>

    <section id="height" class="flex flex-col p-2 gap-4 bg-[#F5F6F8] mt-[30px]"></section>


    <section id="Popular" class="flex flex-col gap-4">
        <div class="flex justify-between items-center px-5 mt-5">
            <h2 class="font-bold">Properti Popular</h2>
            @if($popularKelompok = $kelompoks->where('slug', 'popular')->first())
            <a href="{{ route('lihatsemua', ['propertiType' => $popularKelompok->slug]) }}">
                <div class="flex gap-1 items-center">
                    <span>Lihat Semua</span>
                    <img src="{{ asset('new/assets/images/icons/arrow-right.svg') }}" class="flex w-6 h-6 shrink-0"
                        alt="icon">
                </div>
                </a>
            @endif
        </div>

        <div class="overflow-x-hidden gap-4 w-full swiper">
            <div class="swiper-wrapper">
                @forelse ($projects as $project)
                <div class="swiper-slide !w-fit">
                    <a href="details.html" class="card">
                        <div class="flex flex-col w-[250px] shrink-0 rounded-[30px] border border-[#F1F2F6] p-4 pb-5 gap-[10px] hover:border-[#d40065] text-black transition-all duration-300">
                            <div class="relative">
                                <button class="absolute top-4 right-4 w-max rounded-full p-2 bg-[#d40065] text-white text-xs">
                                    Popular
                                </button>
                                <div class="flex w-full h-[150px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" class="object-cover w-full h-full" alt="thumbnail">
                                </div>
                            </div>

                            <div class="flex flex-col gap-3">
                                <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">{{ $project->nama_project }}</h3>
                                <hr class="border-[#F1F2F6]">
                                <div class="flex items-center gap-[6px]">
                                    <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="flex w-5 h-5 shrink-0"
                                        alt="icon">
                                    <p class="text-sm text-ngekos-grey">{{ $project->lokasi->regency->name }}</p>
                                </div>
                                <div class="flex items-center gap-[6px]">
                                    <img src="{{ asset('new/assets/images/icons/3dcube.svg') }}" class="flex w-5 h-5 shrink-0"
                                        alt="icon">
                                    <p class="text-sm text-ngekos-grey">{{ $project->kategori->kategori }}</p>
                                </div>
                                <div class="flex items-center gap-[6px]">
                                    <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-5 h-5 shrink-0"
                                        alt="icon">
                                    <p class="text-sm text-ngekos-grey">Tersisa {{ $project->project_product->where('status', 'Tersedia')->count() }} Unit</p>
                                </div>

                                    @php
                                        $harga = $project->project_product->min('harga');
                                        $diskon = $project->project_product->min('discount'); // Asumsi diskon dalam persen
                                        $harga_setelah_diskon = $harga - $diskon;
                                    @endphp

                                    <hr class="border-[#F1F2F6]">
                                    <p class="text-sm font-semibold text-black">Rp
                                        {{ number_format($harga_setelah_diskon, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide !w-fit">
                        <p class="items-center text-center">Data belum tersedia</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <section id="Cities" class="flex flex-col p-5 gap-4 bg-[#F5F6F8] mt-[30px]">
        <div class="flex justify-between items-center">
            <h2 class="font-bold">Pilihan Lokasi</h2>
            <a href="{{ route('lihatkota') }}">
                <div class="flex gap-1 items-center">
                    <span>Lihat Semua</span>
                    <img src="{{ asset('new/assets/images/icons/arrow-right.svg') }}" class="flex w-6 h-6 shrink-0"
                        alt="icon">
                </div>
            </a>

        </div>
        <div class="grid grid-cols-2 gap-4">
            @forelse ($cities as $city)
            <a href="cities.html" class="card">
                <div
                    class="flex items-center rounded-[22px] p-[10px] gap-3 bg-white border border-white overflow-hidden hover:border-emerald-text-emerald-600 transition-all duration-300 hover:border-[#d40065] ">
                    <div
                        class="w-[55px] h-[55px] flex shrink-0 rounded-full border-4 border-white ring-1 ring-[#F1F2F6] overflow-hidden">
                        <img src="{{ asset('storage/' . $city->thumbnail) }}" class="object-cover w-full h-full" alt="icon">
                    </div>
                    <div class="flex flex-col gap-[1px]">
                        <h3 class="text-sm"> {{ $city->regency->name }}</h3>
                        <p class="text-sm text-ngekos-grey"> {{ $city->project->count() }} Properti</p>
                    </div>
                </div>
            </a>
            @empty
                <div class="card">
                    <p class="text-center">Data belum tersedia</p>
                </div>
            @endforelse

        </div>
    </section>

    <section id="Best" class="flex flex-col gap-4 px-5 mt-[30px] ">
        <div class="flex justify-between items-center">
            <h2 class="font-bold">Kavling Terbaik</h2>
            @if($popularKelompok = $kelompoks->where('slug', 'terbaik')->first())
            <a href="{{ route('lihatsemua', ['propertiType' => $popularKelompok->slug]) }}">
                <div class="flex gap-1 items-center">
                    <span>Lihat Semua</span>
                    <img src="{{ asset('new/assets/images/icons/arrow-right.svg') }}" class="flex w-6 h-6 shrink-0"
                        alt="icon">
                </div>
            </a>
            @endif
        </div>
        <div class="flex flex-col gap-4">
            @forelse ($kavling as $kavlingterbaik)
            <a href="details.html" class="card">
                <div
                    class="flex rounded-[30px] border border-[#F1F2F6] p-2 gap-4 bg-white hover:border-[#d40065] transition-all duration-300">
                    <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/' . $kavlingterbaik->thumbnail) }}" class="object-cover w-full h-full" alt="icon">
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">{{ $kavlingterbaik->nama_project }}</h3>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $kavlingterbaik->lokasi->regency->name }}</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-5 h-5 shrink-0"
                                alt="icon">
                            <p class="text-sm text-ngekos-grey">Tersisa {{ $kavlingterbaik->project_product->where('status', 'Tersedia')->count() }}</p>
                        </div>
                        <hr class="border-[#F1F2F6]">
                        <p class="text-lg font-semibold text-[#d40065]">
                            Rp {{ number_format($kavlingterbaik->project_product->min('harga')) }}
                        </p>
                    </div>
                </div>
            </a>
            @empty
            @endforelse

        </div>
    </section>

    <section id="Promo" class="relative z-10 flex flex-col gap-3 px-4 mt-6 bg-[#F5F6F8]">
        <h1 class="mt-3 font-semibold">Special Offers</h1>
        <a href="#">
            <div class="w-full aspect-[360/120] flex shrink-0 rounded-[20px] overflow-hidden mb-5">
                <img src="{{ asset('new/assets/images/thumbnails/banner.png') }}" class="object-cover w-full h-full"
                    alt="promo banner">
            </div>
        </a>
    </section>

    <section id="Rekomendasi" class="flex flex-col gap-4 mt-[30px] ">
        <div class="flex justify-between items-center px-5">
            <h2 class="font-bold">Hunian Rekomendasi</h2>
            @if($popularKelompok = $kelompoks->where('slug', 'rekomendasi')->first())
            <a href="{{ route('lihatsemua', ['propertiType' => $popularKelompok->slug]) }}">
                <div class="flex gap-1 items-center">
                    <span>Lihat Semua</span>
                    <img src="{{ asset('new/assets/images/icons/arrow-right.svg') }}" class="flex w-6 h-6 shrink-0"
                        alt="icon">
                </div>
            </a>
            @endif
        </div>
        <div class="overflow-x-hidden w-full swiper">
            <div class="swiper-wrapper">
                @forelse ($rumah as $rumahterbaik)
                <div class="swiper-slide !w-fit">
                    <a href="details.html" class="card">
                        <div
                            class="flex flex-col w-[250px] shrink-0 rounded-[30px] border border-[#F1F2F6] p-4 pb-5 gap-[10px] hover:border-[#d40065] text-black transition-all duration-300">
                            <div class="flex w-full h-[150px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                <img src="{{ asset('storage/' . $rumahterbaik->thumbnail) }}" class="object-cover w-full h-full"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">
                                    {{ $rumahterbaik->nama_project }}
                                </h3>
                                <hr class="border-[#F1F2F6]">
                                <div class="flex items-center gap-[6px]">
                                    <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                                    <p class="text-sm text-ngekos-grey">{{ $rumahterbaik->lokasi->regency->name }}</p>
                                </div>
                                <div class="flex items-center gap-[6px]">
                                    <img src="{{ asset('new/assets/images/icons/3dcube.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                                    <p class="text-sm text-ngekos-grey">{{ $rumahterbaik->kategori->kategori }}</p>
                                </div>
                                <div class="flex items-center gap-[6px]">
                                    <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-5 h-5 shrink-0"
                                        alt="icon">
                                    <p class="text-sm text-ngekos-grey">Tersisa {{ $rumahterbaik->project_product->where('status', 'Tersedia')->count() }} Unit</p>
                                </div>
                                <hr class="border-[#F1F2F6]">
                                <p class="text-lg font-semibold text-[#d40065]">
                                    Rp {{ number_format($rumahterbaik->project_product->min('harga')) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                @endforelse



            </div>
        </div>
    </section>

    <section id="Listing" class="flex flex-col p-5 gap-4 bg-[#F5F6F8] mt-[30px]">
        <div class="flex justify-between items-center">
            <h2 class="font-bold">Listing Terbaru</h2>
            @if($popularKelompok = $kelompoks->where('slug', 'terbaru')->first())
            <a href="{{ route('lihatsemua', ['slug' => $popularKelompok->slug]) }}">
                <div class="flex gap-2 items-center">
                    <span>Lihat Semua</span>
                    <img src="{{ asset('new/assets/images/icons/arrow-right.svg') }}" class="flex w-6 h-6 shrink-0"
                        alt="icon">
                </div>
            </a>
            @endif
        </div>
        <div class="gap-4 swiper grider-cols-2">
            <div class="swiper-wrapper">

                <div class="swiper-slide !w-fit pb-[30px] ">
                    <a href="list-city.html" class="card">
                        <div
                            class="flex flex-col items-center w-[120px] shrink-0 rounded-[40px] p-4 pb-5 gap-3 bg-white shadow-[0px_12px_30px_0px_#0000000D] text-center ">
                            <div class="w-[70px] h-[70px] rounded-full flex shrink-0 overflow-hidden ">
                                <img src="{{ asset('new/assets/images/thumbnails/flats.png') }}"
                                    class="object-cover w-full h-full" alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[2px] ">
                                <h3 class="font-semibold">Rumah Baru</h3>
                                <p class="text-sm text-ngekos-grey">1,304</p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    @include('includes.footer')
@endsection

@push('addon-script')
@endpush
