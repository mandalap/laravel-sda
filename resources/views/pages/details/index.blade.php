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

        <div id="ForegroundFade"
            class="absolute top-0 w-full h-[143px] bg-[linear-gradient(180deg,#070707_0%,rgba(7,7,7,0)_100%)] z-10">
        </div>

        <div id="TopNavAbsolute" class="absolute top-[30px] flex items-center justify-between w-full px-5 z-10">
            <a href="{{ route('detailkategori', [$kategori->slug, $project->lokasi->slug]) }}"
                class="flex overflow-hidden justify-center items-center w-12 h-12 rounded-full backdrop-blur-sm shrink-0 bg-white/10">
                <img src="{{ asset('new/assets/images/icons/arrow-left-transparent.svg') }}" class="w-8 h-8" alt="icon">
            </a>
            <p class="font-semibold text-white">Details</p>
            <button
                class="flex overflow-hidden justify-center items-center w-12 h-12 rounded-full backdrop-blur-sm shrink-0 bg-white/10">
                <img src="{{ asset('new/assets/images/icons/like.svg') }}" class="w-[26px] h-[26px]" alt="">
            </button>
        </div>

        <div id="Gallery" class="swiper-gallery w-full overflow-x-hidden -mb-[38px]">
            <div class="swiper-wrapper">
                @forelse ($photos as $photo)
                <div class="swiper-slide !w-fit">
                    <div class="flex shrink-0 w-[320px] h-[430px] overflow-hidden">
                        <img src="{{ asset('storage/' . $photo->photo) }}" class="object-cover w-full h-full"
                            alt="gallery thumbnails">
                    </div>
                </div>
                @empty
                <div class="swiper-slide !w-fit">
                    <div class="flex shrink-0 w-[320px] h-[430px] overflow-hidden">
                        <img src="{{ $photo->url }}" class="object-cover w-full h-full"
                            alt="gallery thumbnails">
                    </div>
                </div>
                @endforelse

            </div>
        </div>

        <main id="Details" class="relative flex flex-col rounded-t-[40px] py-5 pb-[10px] gap-4 bg-white z-10">
            <div id="Title" class="flex gap-2 justify-between items-center px-5">
                <h1 class="font-bold text-[22px] leading-[33px]">{{ $project->nama_project }}</h1>

            </div>
            <hr class="border-[#F1F2F6] mx-5">
            <div id="Features" class="grid grid-cols-2 gap-x-[10px] gap-y-4 px-5">
                <div class="flex items-center gap-[6px]">
                    <img src="{{ asset('new/assets/images/icons/location.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
                    <p class="text-sm text-grey">{{ $project->lokasi->regency->name }}</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <img src="{{ asset('new/assets/images/icons/3dcube.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
                    <p class="text-sm text-grey">{{ $project->kategori->kategori }}</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <img src="{{ asset('new/assets/images/icons/profile-2user.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
                    <p class="text-sm text-grey">Terisa {{ $project->project_product->where('status', 'Tersedia')->count() }} Unit</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <img src="{{ asset('new/assets/images/icons/shield-tick.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
                    <p class="text-sm text-grey">Terverikasi</p>
                </div>
            </div>
            <hr class="border-[#F1F2F6] mx-5">
            <div id="About" class="flex flex-col gap-[6px] px-5">
                <h2 class="font-bold">Deskripsi</h2>
                <p class="leading-[30px]">{{ $project->deskripsi }}</p>
            </div>
            <div id="Tabs" class="overflow-x-hidden w-full swiper-tab">
                <div class="swiper-wrapper">
                    <div class="swiper-slide !w-fit">
                        <button
                            class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300 !bg-ngekos-black !text-white"
                            data-target-tab="#Bonus-Tab">Fasilitas</button>
                    </div>
                    <div class="swiper-slide !w-fit">
                        <button
                            class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                            data-target-tab="#Testimonials-Tab">Siteplan</button>
                    </div>
                    <div class="swiper-slide !w-fit">
                        <button
                            class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                            data-target-tab="#Rules-Tab">Brosur</button>
                    </div>
                    <div class="swiper-slide !w-fit">
                        <button
                            class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                            data-target-tab="#Contact-Tab">Video</button>
                    </div>
                    <div class="swiper-slide !w-fit">
                        <button
                            class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                            data-target-tab="#Rewards-Tab">Maps</button>
                    </div>
                </div>
            </div>

            <div id="TabsContent" class="px-5">
                <div id="Bonus-Tab" class="flex flex-col gap-5 tab-content">
                    <div class="flex flex-col gap-4">
                        @forelse ( $facilities as $facility )
                        <div
                            class="bonus-card flex items-center rounded-[22px] border border-[#F1F2F6] p-[10px] gap-3 hover:border-[#d40065] transition-all duration-300">
                            <div class="flex w-[26px] h-[26px] shrink-0">
                                <img src="{{ asset('new/assets/images/icons/check-mark.svg') }}" class="object-cover w-full h-full"
                                    alt="icon">
                            </div>
                            <div>
                                <p class="font-semibold">{{ $facility->fasilitas }}</p>
                                <p class="text-sm text-ngekos-grey">Faslitas</p>
                            </div>
                        </div>
                        @empty
                        <div
                            class="bonus-card flex items-center rounded-[22px] border border-[#F1F2F6] p-[10px] gap-3 hover:border-[#d40065] transition-all duration-300">
                            <div class="flex w-[26px] h-[26px] shrink-0">
                                <img src="{{ asset('new/assets/images/icons/check-mark.svg') }}" class="object-cover w-full h-full"
                                    alt="icon">
                            </div>
                            <div>
                                <p class="font-semibold">Belum Ada Fasilitas</p>
                                <p class="text-sm text-ngekos-grey">Fasilitas</p>
                            </div>
                        </div>
                        @endforelse

                    </div>
                </div>
                <div id="Testimonials-Tab" class="hidden flex-col gap-5 tab-content">
                    <div class="flex flex-col gap-4">
                        <div
                            class="testi-card flex flex-col rounded-[22px] border border-[#F1F2F6] p-4 gap-3 bg-white hover:border-[#d40065] transition-all duration-300">
                            <div class="flex gap-3 items-center">
                                <div
                                    class="w-[70px] h-[70px] flex shrink-0 rounded-full border-4 border-white ring-1 ring-[#F1F2F6] overflow-hidden">
                                    <img src="assets/images/photos/sami.png" class="object-cover w-full h-full"
                                        alt="icon">
                                </div>
                                <div>
                                    <p class="font-semibold">Samina Ryin</p>
                                    <p class="mt-[2px] text-sm text-ngekos-grey">9 September 2024</p>
                                </div>
                            </div>
                            <p class="leading-[26px]">Enak banget ngekos di sini sampe lupa rumah emak saking nyamannya
                                lol...</p>
                            <div class="flex">
                                <img src="assets/images/icons/Star 1.svg" class="w-[22px] h-[22px] flex shrink-0"
                                    alt="">
                                <img src="assets/images/icons/Star 1.svg" class="w-[22px] h-[22px] flex shrink-0"
                                    alt="">
                                <img src="assets/images/icons/Star 1.svg" class="w-[22px] h-[22px] flex shrink-0"
                                    alt="">
                                <img src="assets/images/icons/Star 1.svg" class="w-[22px] h-[22px] flex shrink-0"
                                    alt="">
                                <img src="assets/images/icons/Star 1.svg" class="w-[22px] h-[22px] flex shrink-0"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Rules-Tab" class="hidden flex-col gap-5 tab-content">
                    Brosur
                </div>
                <div id="Contact-Tab" class="hidden flex-col gap-5 tab-content">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/MAUanyqHEqc?si=ZG3VkLYVPMNVdYPW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div id="Rewards-Tab" class="hidden flex-col gap-5 tab-content">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d37861.70197033057!2d109.31364600000003!3d-0.04458950000000253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sid!4v1740366145418!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </main>

        <div id="BottomNav" class="relative flex w-full h-[138px] shrink-0">
            <div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
                <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-gradient-to-r from-[#a7006d] to-[#d40065]">
                    <p class="font-bold text-lg leading-[30px] text-white">
                        Rp 100.000
                    </p>
                    @if ($project->project_product->where('status', 'Tersedia')->count() == '0')
                        <a href="#"
                            class="flex shrink-0 rounded-full py-[14px] px-5 bg-white font-bold text-[#d40065] hover:bg-black hover:text-white">Tidak tersedia</a>
                    @else
                    <a href="{{ route('custinfo', [$project->jenis->slug, $project->kategori->slug, $project->slug]) }}"
                        class="flex shrink-0 rounded-full py-[14px] px-5 bg-white font-bold text-[#d40065] hover:bg-black hover:text-white">Booking Sekarang</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
<script>
    const swiperCategories = new Swiper('.swiper-choose', {
        direction: 'horizontal',
        spaceBetween: 14,
        slidesOffsetBefore: 16,
        slidesOffsetAfter: 16,
        slidesPerView: 'auto',
    });
    const swiperPopular = new Swiper('.swiper-popular', {
        direction: 'horizontal',
        spaceBetween: 16,
        slidesOffsetBefore: 16,
        slidesOffsetAfter: 16,
        slidesPerView: 'auto',
    });
</script>
@endpush
