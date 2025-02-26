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
    <div id="Background" class="absolute top-0 w-full h-[570px] rounded-bl-[30px] rounded-br-[30px] bg-gradient-to-r from-[#a7006d] to-[#d40065]">
    </div>
    <div id="TopNav" class="flex relative justify-between items-center px-5 pt-5">
        <a href="{{ route('beranda') }}"
            class="flex overflow-hidden justify-center items-center w-10 h-10 bg-white rounded-full shrink-0">
            <img src="{{asset('new/assets/images/icons/arrow-left.svg')}}" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <h3 class="text-lg font-bold text-white">Semua Properti</h3>
        <div class="w-10 dummy-btn"></div>
    </div>
    <div id="Header" class="relative flex flex-col items-center gap-2 px-5 mt-[18px] text-center">
        <h1 class="font-bold text-[20px] leading-[30px] text-white">Properti {{ $kelompok->kelompok }}</h1>
        <p class="text-white">{{ $projectCount }} Project Ditemukan</p>
    </div>
    <form action="" class="flex relative z-10 flex-col gap-6 mt-6">
        <div class="flex flex-col gap-2 px-4">
        <label for="Location" class="font-semibold text-white">Pencarian</label>
        <div class="rounded-full flex items-center p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-black">
            <div class="w-6 h-6 flex shrink-0 mr-[6px]">
            <img src="{{ asset('new/assets/images/icons/search.svg') }}" alt="icon">
            </div>
            <input type="text" name="location" id="Location" class="w-full bg-white outline-none" placeholder="Masukkan nama jalan, nama kota nama daerah">
        </div>
        </div>
    </form>

    @forelse ( $projects as $project )
    @php
        // Menghitung jumlah produk tersedia untuk proyek saat ini
        $jumlahProdukTersedia = $project->project_product()->where('status', 'Tersedia')->count();
    @endphp

    <section id="Result" class="flex relative flex-col gap-4 px-5 mt-5 mb-3">
        <a href="{{ route('detailproject', [$project->jenis->slug, $project->kategori->slug, $project->slug]) }}" class="card">
            <div class="flex rounded-[30px] border border-[#F1F2F6] p-2 gap-4 bg-white hover:border-[#d40065] transition-all duration-300">
                <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" class="object-cover w-full h-full" alt="icon">
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">{{ $project->nama_project }}</h3>
                    <hr class="border-[#F1F2F6]">
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $project->lokasi->regency->name }}</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="flex w-5 h-5 shrink-0" alt="icon">
                        <p class="text-sm text-ngekos-grey">Tersedia - {{ $jumlahProdukTersedia }} Properti </p>
                    </div>
                    <hr class="border-[#F1F2F6]">
                    <p class="font-semibold text-lg text-[#d40065]">
                        Rp {{ number_format($project->project_product->min('harga')) }}
                    </p>
                </div>
            </div>
        </a>
    </section>
    @empty
        <p class="text-center">Tidak ada properti tersedia</p>
    @endforelse
</div>

@endsection


