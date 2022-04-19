@extends('public.layouts.app')

@section('content')

<div class="utama-page">
    <section class="mb-3 h-100">
        <div class="container">
            <div class="main-slider splide" id="headerSplide">
                <div class="splide__slider">
                    <div class="splide__track br-10">
                        <ul class="splide__list">
                            @foreach ($headers as $key => $header)
                            <li class="splide__slide {{$key == 0 ? 'active' : '' }}">
                                <img src="{{ $header->thumbnail->relativeUrl }}" class="img-cover d-block h-100 w-100 " alt="{{ $header->thumbnail->alt }}">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="splide__progress m-2 bg-semidark">
                        <div class="splide__progress__bar bg-yellow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mb-3">
        <div class="container">
            <div class="top-card-container owl-carousel owl-theme">
                <div class="top-card-item">
                    <img src="{{ asset('images/public-image/top-card/kssb-logo.png') }}" class="img-block" alt="logo">
                </div>
                <div class="top-card-item">
                    <img src="{{ asset('images/public-image/top-card/infaq-logo.png') }}" class="img-block" alt="logo">
                </div>
                <div class="top-card-item">
                    <img src="{{ asset('images/public-image/top-card/tanwir-logo.png') }}" class="img-block" alt="logo">
                </div>
                <div class="top-card-item">
                    <img src="{{ asset('images/public-image/top-card/iltizam-logo.png') }}" class="img-block" alt="logo">
                </div>
            </div>
        </div>
    </section>
    
    <section class="mb-3">
        <div class="container">
            <div class="br-10 bg-yellow p-4">
                <h3 class="text-shadow text-white text-center fs-mb-normal fw-semibold fs-3 lh-1 mb-3">
                    Jadual Imsak Dan Waktu Berbuka<br> Negeri-Negeri Seluruh Malaysia<br> Bagi Tahun 1443H / 2022M
                </h3>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-mb btn-outline-light" href="{{ asset('takwim_ramadan/takwim2022.pdf') }}" target="_blank">
                        Klik Untuk Muat Turun
                    </a>
                </div>
            </div>
        </div>
    </section>
        
    <section class="mb-3">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">Panduan Ramadan & Syawal</h2>
                <a href="{{ route('book', $bookOutSourceCatId) }}" class="btn text-decoration-none">Lihat Kesemua E-Book</a>
            </div>
            <div class="ebook-outsource-carousel owl-carousel owl-theme" id="outSourcePdf">
                @foreach ($bookOutSource as $book)
                <div class="ebook-outsource">
                    @if ($book->is_redirect)
                        <a href="{{ $book->book_url }}">
                            <img src="{{ $book->thumbnail->relativeUrl }}"  class="ebook-img" alt="{{ $book->book_name }}">
                        </a>
                    @else
                        <a class="ebook-pdf c-pointer" data-src="{{ $book->pdf->url }}" data-iframe="true">
                            <img src="{{ $book->thumbnail->relativeUrl }}"  class="ebook-img" alt="{{ $book->book_name }}">
                        </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="mb-3">
        <div class="container ebook2">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">E-Book Terbitan ABIM Sempena Ramadan Dan Syawal</h2>
                <a href="{{ route('book', $bookAbimCatId) }}" class="btn text-decoration-none">Lihat Kesemua E-Book</a>
            </div>
            <div class="card-shadow-only p-2">
                <div class="ebook-abim-carousel owl-carousel owl-theme" id="abimPdf">
                    @foreach ($bookAbim as $book)
                    <div class="ebook-abim">
                        @if ($book->is_redirect)
                            <a href="{{ $book->book_url }}">
                                <img src="{{ $book->thumbnail->relativeUrl }}"  class="ebook-img" alt="{{ $book->book_name }}">
                            </a>
                        @else
                            <a class="ebook-pdf c-pointer" data-src="{{ $book->pdf->url }}" data-iframe="true">
                                <img src="{{ $book->thumbnail->relativeUrl }}"  class="ebook-img" alt="{{ $book->book_name }}">
                            </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    @if ($infaqMain)
    <section class="mb-3" id="sumbang">
        <div class="container">
            <div class="title">
                <h2 class="fw-semibold fs-5 mb-0">Kempen Infaq Ramadan</h2>
            </div>
            <div class="card-container d-flex justify-content-center">
                <div class="card card-large">
                    <a class="text-decoration-none w-100" href="{{ $infaqMain->group_url }}">
                        <div class="m-2 br-10 overflow-hidden">
                            <img src="{{ ($infaqMain->group_thumbnail) ? $infaqMain->thumbnail->relativeUrl : Config::get('global.public_image_path') . 'no-image-default.jpg'  }}" class="img-cover h-100 w-100" alt="{{ $infaqMain->group_name }}">
                        </div>
                        <div class="card-body pt-0">
                            <h3 class="card-text fw-bold text-dark fs-6">{{ $infaqMain->group_name }}</h3>
                            <div class="d-flex justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="text-white fw-semibold btn bg-yellow px-3">
                                        <span class="">Sumbang</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
        
    <section class="mb-3">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">Bicara Tanwir Ramadan</h2>
                <a href="{{ route('video', $tanwirProgramId) }}" class="btn text-decoration-none">Lihat Semua Perkongsian</a>
            </div>
            <div class="tanwir-video-carousel owl-carousel owl-theme" id="tanwir-gallery-videos">
                @foreach ($tanwirVideos as $video)
                <div class="kssb-video-item video-item h-100">
                    <a class="video-wrapper text-decoration-none h-100" data-lg-size="1280-720" data-src="//www.youtube.com/watch?v={{ $video->youtube_id }}"
                        data-poster="{{ ($video->video_thumbnail) ? $video->thumbnail->relativeUrl : 'https://img.youtube.com/vi/' . $video->youtube_id . '/maxresdefault.jpg'}}"
                        data-sub-html="<h4 class='mb-3'>{{ $video->video_name }}</h4>">
                        <img class="img-cover img-fluid h-100" alt="{{ $video->video_name }}"
                        src="{{ ($video->video_thumbnail) ? $video->thumbnail->relativeUrl : 'https://img.youtube.com/vi/' . $video->youtube_id . '/maxresdefault.jpg'}}" />
                        <div class="play-overlay"><i class="bi bi-play-fill"></i></div>
                        <div class="title-overlay p-2 text-white fw-semibold lh-1">{{ \Illuminate\Support\Str::limit($video->video_name, 60, '...') }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
        
    @if ($kssbMain)
    <section class="mb-3">
        <div class="container">
            <div class="title">
                <h2 class="fw-semibold fs-5 mb-0">Kempen Seorang Sekampit Beras</h2>
            </div>
            <div class="card-container d-flex justify-content-center">
                <div class="card card-large">
                    <a class="text-decoration-none w-100" href="{{ $kssbMain->group_url }}">
                        <div class="m-2 br-10 overflow-hidden">
                            <img src="{{ ($kssbMain->group_thumbnail) ? $kssbMain->thumbnail->relativeUrl : Config::get('global.public_image_path') . 'no-image-default.jpg'  }}" class="img-cover h-100 w-100" alt="{{ $kssbMain->group_name }}">
                        </div>
                        <div class="card-body pt-0">
                            <h3 class="card-text fw-bold text-dark fs-6">{{ $kssbMain->group_name }}</h3>
                            <div class="d-flex justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="arrow-button text-white fw-semibold btn px-3 bg-yellow">
                                        <span class="">Sumbang</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
           
    <section class="mb-3" id="kssb-negeri-section">
        <div class="container">
            <div class="title">
                <h2 class="fw-semibold fs-5 mb-0">Kempen Seorang Sekampit Beras Abim Negeri & Daerah</h2>
            </div>
            <div class="card-container kssb-negeri-container owl-carousel owl-theme">
                @foreach ($kssbNegeri as $item)
                    <div class="card card-small">
                        <a class="text-decoration-none w-100" href="{{ $item->group_url }}">
                            <div class="m-2 br-10 overflow-hidden">
                                <img src="{{ $item->thumbnail->relativeUrl }}" class="img-cover w-100" alt="{{ $item->group_name }}">
                            </div>
                            <div class="card-body pt-0">
                                <h3 class="card-text fw-bold text-dark fs-6">{{ $item->group_name }}</h3>
                                <span></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
        
    <section class="mb-3">
        <div class="container">
            <div class="title">
                <h2 class="fw-semibold fs-5 mb-0">Penganjur Bersama</h2>
            </div>
            <div class="penganjur-carousel owl-carousel owl-theme">
                <div class="penganjur-item">
                    <img src="{{ asset('images/public-image/penganjur/penganjur1.png') }}" class="penganjur-bersama" alt="logo">
                </div>
                <div class="penganjur-item">
                    <img src="{{ asset('images/public-image/penganjur/penganjur2.png') }}" class="penganjur-bersama" alt="logo">
                </div>
                <div class="penganjur-item">
                    <img src="{{ asset('images/public-image/penganjur/penganjur3.png') }}" class="penganjur-bersama" alt="logo">
                </div>
                <div class="penganjur-item">
                    <img src="{{ asset('images/public-image/penganjur/penganjur4.png') }}" class="penganjur-bersama" alt="logo">
                </div>
                <div class="penganjur-item">
                    <img src="{{ asset('images/public-image/penganjur/penganjur5.png') }}" class="penganjur-bersama" alt="logo">
                </div>
                <div class="penganjur-item">
                    <img src="{{ asset('images/public-image/penganjur/penganjur6.png') }}" class="penganjur-bersama" alt="logo">
                </div>
            </div>
        </div>
    </section>
    
    <section id="hadis-hijau-section" class="mb-3">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">30 Hadis Hijau Ramadan</h2>
                <a href="{{ route('gallery', $hadisProgramId) }}" class="btn text-decoration-none">Lihat Semua Hadis</a>
            </div>
            <div class="hadis-container row g-2" id="hadisContainer">
                @foreach ($hadisImg as $key => $item)
                    @if ($key == 0)
                    <div class="hadis-main col-12">
                        <a class="hadis-item" href="{{ $item->relativeUrl }}">
                            <div class="foto-img-container">
                                <img src="{{ $item->relativeUrl }}" alt="{{ $item->original_name }}" class="img-cover">
                                <div class="zoom-overlay"><i class="bi bi-search"></i></div>
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="hadis-sub col-4">
                        <a class="hadis-item" href="{{ $item->relativeUrl }}">
                            <div class="foto-img-container">
                                <img src="{{ $item->relativeUrl }}" alt="{{ $item->original_name }}" class="img-cover">
                                <div class="zoom-overlay"><i class="bi bi-search"></i></div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="mb-3" id="projek-ramadan-section">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">30 Projek Ramadan</h2>
                <a href="{{ route('gallery', $projekProgramId) }}" class="btn text-decoration-none">Lihat Semua Projek</a>
            </div>
            <div class="projek-carousel owl-carousel owl-theme" id="projekContainer">
                @foreach ($projekImg as $item)
                <a class="projek-item" href="{{ $item->relativeUrl }}">
                    <div class="foto-img-container">
                        <img src="{{ $item->relativeUrl }}" alt="{{ $item->original_name }}" class="img-cover">
                        <div class="zoom-overlay"><i class="bi bi-search"></i></div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
        
    <section class="mb-3" id="lokasi">
        @livewire('map-layout')
    </section>
    
    @if (!$kssbPenyaluran->isEmpty())
    <section class="mb-3">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">Kemaskini Penyaluran Bantuan KSSB</h2>
                <a href="{{ route('penyaluran') }}" class="btn text-decoration-none">Lihat Jadual Penuh</a>
            </div>
            <div class="br-10 shadow p-2">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                            <th scope="col">Bil</th>
                            <th scope="col">Daerah/Mukim</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Penerima</th>
                            <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $bil = 1;
                            @endphp
                            @foreach ($kssbPenyaluran as $item)
                            <tr>
                                <td scope="row">{{ $bil }}</td>
                                <td>{{ $item->group->district }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->receiver }}</td>
                                <td>RM {{ $item->distribute_amount }}</td>
                            </tr>
                            @php
                                $bil++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section> 
    @endif
    
    <section class="mb-3" id="maklumat">
        <div class="container">
            <div class="title">
                <h2 class="fw-semibold fs-5 mb-0">Graf Jumlah Kutipan KSSB</h2>
            </div>
            @include('public.partials.kssb-chart')
            <p class="small text-center fw-semibold">*Jumlah kutipan tidak termasuk jumlah kutipan Abim Negeri & Daerah</p>
        </div>
    </section>
        
    <section class="mb-3" id="kssb-foto-section">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">Galeri Foto KSSB</h2>
                <a href="{{ route('gallery', $kssbProgramId) }}" class="btn text-decoration-none">Lihat Kesemua Foto</a>
            </div>
            <div class="row g-2" id="lg-galeri-foto">
                @foreach ($kssbImages as $image)
                <div class="col-6">
                    <a class="lg-foto-item" href="{{ $image->relativeUrl }}">
                        <div class="foto-img-container">
                            <img src="{{ $image->relativeUrl }}" class="kssb-foto img-cover img-fluid"
                            alt="{{ $image->original_name }}">
                            <div class="zoom-overlay"><i class="bi bi-search"></i></div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="mb-3">
        <div class="container">
            <div class="title-with-link">
                <h2 class="fw-semibold fs-5 mb-0">Galeri Video KSSB</h2>
                <a href="{{ route('video', $kssbProgramId) }}" class="btn text-decoration-none">Lihat Kesemua Video</a>
            </div>
            <div class="kssb-video-carousel owl-carousel owl-theme" id="kssb-gallery-videos">
                @foreach ($kssbVideos as $video)
                <div class="kssb-video-item video-item">
                    <a class="video-wrapper text-decoration-none" data-lg-size="1280-720" data-src="//www.youtube.com/watch?v={{ $video->youtube_id }}"
                        data-poster="{{ ($video->video_thumbnail) ? $video->thumbnail->relativeUrl : 'https://img.youtube.com/vi/' . $video->youtube_id . '/maxresdefault.jpg'}}"
                        data-sub-html="<h4 class='mb-3'>{{ $video->video_name }}</h4>">
                        <img class="img-responsive img-fluid" alt="{{ $video->video_name }}"
                        src="{{ ($video->video_thumbnail) ? $video->thumbnail->relativeUrl : 'https://img.youtube.com/vi/' . $video->youtube_id . '/maxresdefault.jpg'}}" />
                        <div class="play-overlay"><i class="bi bi-play-fill"></i></div>
                        <div class="title-overlay p-2 text-white fw-semibold lh-1">{{ \Illuminate\Support\Str::limit($video->video_name, 60, '...') }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection
