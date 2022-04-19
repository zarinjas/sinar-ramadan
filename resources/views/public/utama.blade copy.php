@extends('public.layouts.header')
@extends('public.partials.map')
@section('content')
<div class="row justify-content-center fixed-bottom">
    <div class="col-12 col-lg-6 d-flex justify-content-center">
        <div class="container d-flex bnavbar justify-content-center">

            <div class="col-3 colbnavbar d-flex flex-column align-items-center">

                <i class="bi bi-house-door-fill nav__icon text-white" style="font-size:25px;"></i>
                <p class="navlink fw-normal text-white">UTAMA</p>

            </div>
            <div class="col-3 d-flex flex-column align-items-center">
                <i class="bi bi-box2-heart-fill nav__icon text-white" style="font-size:25px;"></i>
                <p class="navlink fw-normal text-white">SUMBANG</p>
            </div>
            <div class="col-3 d-flex flex-column align-items-center">
                <i class="bi bi-map-fill nav__icon text-white" style="font-size:25px;"></i>
                <p class="navlink fw-normal text-white">PETA</p>
            </div>
            <div class="col-3 d-flex flex-column align-items-center">
                <i class="bi bi-pie-chart-fill nav__icon text-white" style="font-size:25px;"></i>
                <p class="navlink fw-normal text-white">MAKLUMAT</p>
            </div>

        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12">




        <div class="container ">
            <div id="carouselExampleControls" class="carousel slide shadow-sm p-3 mb-5 bg-body rounded"
                data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{URL::asset('/custom_link/banner1.png')}}" class="d-block w-100 h-75" alt="banner1">

                        <div class="carousel-caption ">
                            <div class="banner-text">
                                <h2>مَنْ صَامَ رَمَضَانَ إِيمَا ا نً وَاحْتِسَا ا بً غُفِرَ لََُ مَا تقََدَّمَ مِنْ
                                    ذَنبِْهِ<br>

                                    Siapa yang berpuasa dengan penuh keimanan dan mengharapkan keredhaan Allah, maka
                                    akan diampunkan segala dosanya yang telah lalu.<br>
                                    (Riwayat Al-Bukhari)
                                </h2>
                            </div>
                        </div>

                    </div>
                    <div class="carousel-item">
                        <img src="{{URL::asset('/custom_link/banner2.png')}}" class="d-block w-100 h-75" alt="banner2">
                        <div class="carousel-caption ">
                            <div class="banner-text">
                                <div class="text-bg-banner">
                                    <span class="platform">
                                        Platform Terbaik</span>
                                </div>
                                <h2>
                                    mendapatkan maklumat-maklumat tentang inisiatif, hebahan maklumat dan program,
                                    laporan dan berita aktiviti, kempen-kempen, kajian dan sebagainya tentang agenda
                                    Sinar Ramadan ABIM.
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container">
            <div class="owl-carousel top-carousel owl-theme">
                <div class="item">
                    <img src="{{URL::asset('/custom_link/top_car_logo1.png')}}" class="top-car" alt="logo">
                </div>
                <div class="item">
                    <img src="{{URL::asset('/custom_link/top_car_logo2.png')}}" class="top-car" alt="logo">
                </div>
                <div class="item">
                    <img src="{{URL::asset('/custom_link/top_car_logo3.png')}}" class="top-car" alt="logo">
                </div>
                <div class="item">
                    <img src="{{URL::asset('/custom_link/top_car_logo4.png')}}" class="top-car" alt="logo">
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container jadual-buka">
    <p class="jadual text-center fw-bold fs-2 lh-1 pt-4 ">
        Jadual Imsak Dan Waktu Berbuka<br> Negeri-Negeri Seluruh Malaysia<br> Bagi Tahun 1443H / 2022M
    </p>
    <div class="d-flex justify-content-center pb-3">
        <a href="{{ asset('takwim_ramadan/takwim2022.pdf') }}" target="_blank">
            <button type="button" class="btn btn-outline-light ">Klik Untuk Muat Turun

            </button></a>
    </div>
</div>

<div class="container pt-3 pb-3">
    <div class="row">
        <div class="col-6 d-flex justify-content-start">
            <p class="fw-bold fs-5">Panduan Ramadhan & Syawal</p>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="#" class="text-decoration-none">
                <p class="ebook_link">Lihat Kesemua E-Book</p>
            </a>
        </div>
    </div>
    <div class="owl-carousel ebook-carousel owl-theme">
        <div class="ebooktop">
            <img src="{{URL::asset('/custom_link/ebook_top1.png')}}" class="ebooktop " alt="ebooktop">
        </div>
        <div class="ebooktop">
            <img src="{{URL::asset('/custom_link/ebook_top2.png')}}" class="ebooktop " alt="ebooktop">
        </div>
        <div class="ebooktop">
            <img src="{{URL::asset('/custom_link/ebook_top3.png')}}" class="ebooktop " alt="ebooktop">
        </div>




    </div>

</div>


<div class="container ebook2 pt-3 pb-2">
    <div class="row">
        <div class="col-8 d-flex justify-content-start align-items-center">
            <p class="fw-bold fs-5">E-Buku Terbitan ABIM Sempena Ramadhan Dan Syawal
            </p>
        </div>
        <div class="col-4 d-flex justify-content-end">
            <a href="#" class="text-decoration-none">
                <p class="ebook_link">Lihat Kesemua E-Book
                </p>
            </a>
        </div>
    </div>
    <div class="container ebook1 ">
        <div class="owl-carousel ebook-carousel owl-theme">
            <div class="ebook-item img-fluid">
                <img src="{{URL::asset('/custom_link/ebook1.png')}}" class="ebook2 " alt="ebook2">
            </div>
            <div class="ebook-item img-fluid">
                <img src="{{URL::asset('/custom_link/ebook2.png')}}" class="ebook2 " alt="ebook2">
            </div>
            <div class="ebook-item img-fluid">
                <img src="{{URL::asset('/custom_link/ebook3.png')}}" class="ebook2 " alt="ebook2">
            </div>
            <div class="ebook-item img-fluid">
                <img src="{{URL::asset('/custom_link/ebook4.png')}}" class="ebook2 " alt="ebook2">
            </div>
            <div class="ebook-item img-fluid">
                <img src="{{URL::asset('/custom_link/ebook5.png')}}" class="ebook2 " alt="ebook2">
            </div>
        </div>
    </div>
</div>

<div class="container pt-3">
    <p class="fw-bold fs-5">Kempen Infaq Ramadhan</p>
</div>
<div class="container d-flex justify-content-center pt-3 pb-5">
    <div class="card infaq-card" style="width: 25rem;">
        <img src="{{URL::asset('/custom_link/infaq.png')}}" class="card-img-top ps-2 pe-2 pt-2" alt="...">
        <div class="card-body">
            <p class="card-text text-center fw-bold fs-5">Kempen Infaq Ramadan KSSB</p>


            <div class="percent d-flex justify-content-center pb-3">
              <a href=" {{ url('https://infaqabim.onpay.my/order/form/infaqramadan') }}" target="_blank">
                <button type="button" class="btn btn-warning text-white fw-bold">SUMBANG</button>
            </div></a>

        </div>
    </div>
</div>

<div class="container tanwir-cntnr">
    <p class="fw-bold fs-5">Bicara Tanwir Ramadhan</p>
</div>
<div class="container tanwir-cntr ">
    <div class="owl-carousel tanwir-carousel owl-theme">
        <div class="tanwir-item">
            <img src="{{URL::asset('/custom_link/tanwir1.png')}}" class="tanwir " alt="tanwir">
        </div>
        <div class="tanwir-item">
            <img src="{{URL::asset('/custom_link/tanwir2.png')}}" class="tanwir " alt="tanwir">
        </div>
        <div class="tanwir-item">
            <img src="{{URL::asset('/custom_link/tanwir3.png')}}" class="tanwir " alt="tanwir">
        </div>

    </div>
</div>

<div class="container">
    <p class="fw-bold fs-5">Kempen Seorang Sekampit Beras</p>
</div>
<div class="container d-flex justify-content-center pt-3 pb-3">
    <div class="card infaq-card" style="width: 25rem;">
        <img src="{{URL::asset('/custom_link/kssb.png')}}" class="card-img-top ps-2 pe-2 pt-2" alt="...">
        <div class="card-body">
            <p class="card-text text-center fw-bold fs-5">Kempen Seorang Sekampit Beras</p>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="percent d-flex justify-content-between ">
                <span>RM 31,000.00</span>
                <span>34.5%</span>
            </div>
        </div>
    </div>
</div>


<div class="container pt-4 ">
    <p class="fw-bold fs-5">Kempen Seorang Sekampit Beras Abim Negeri & Daerah</p>
    <div class="owl-carousel kssbnegeri-carousel owl-theme ">
        <div class="kssbnegeri-item">
            <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                <img src="{{URL::asset('/custom_link/kssb-kl.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Kempen KSSB Wilayah</h5>

                    <a href="#" class="btn btn-warning text-white">SUMBANG</a>
                </div>
            </div>
        </div>
        <div class="kssbnegeri-item">
            <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                <img src="{{URL::asset('/custom_link/kssb-selangor.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Kempen KSSB Selangor</h5>

                    <a href="#" class="btn btn-warning text-white">SUMBANG</a>
                </div>
            </div>
        </div>
        <div class="kssbnegeri-item">
            <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                <img src="{{URL::asset('/custom_link/kssb-kedah.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Kempen KSSB Kedah</h5>

                    <a href="#" class="btn btn-warning text-white">SUMBANG</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pt-4 ">
    <p class="fw-bold fs-5">Penganjur Bersama</p>
    <div class="container">
        <div class="owl-carousel penganjur-carousel owl-theme">
            <div class="item">
                <img src="{{URL::asset('/custom_link/penganjur/penganjur1.png')}}" class="penganjur-bersama" alt="logo">
            </div>
            <div class="item">
                <img src="{{URL::asset('/custom_link/penganjur/penganjur2.png')}}" class="penganjur-bersama" alt="logo">
            </div>
            <div class="item">
                <img src="{{URL::asset('/custom_link/penganjur/penganjur3.png')}}" class="penganjur-bersama" alt="logo">
            </div>
            <div class="item">
                <img src="{{URL::asset('/custom_link/penganjur/penganjur4.png')}}" class="penganjur-bersama" alt="logo">
            </div>
            <div class="item">
                <img src="{{URL::asset('/custom_link/penganjur/penganjur5.png')}}" class="penganjur-bersama" alt="logo">
            </div>
            <div class="item">
                <img src="{{URL::asset('/custom_link/penganjur/penganjur6.png')}}" class="penganjur-bersama" alt="logo">
            </div>
        </div>
    </div>
</div>

<div class="container jadual-buka pt-4">
  <p class="jadual text-center fw-bold fs-2 lh-1 pt-4 ">
        Butiran Lokasi Pengumpulan Sumbangan
    </p>
    <div class="d-flex justify-content-center pb-3">
        <a href="{{ URL('https://docs.google.com/spreadsheets/d/1zjB5z_bRpPLBeBizfT0ADaqJVasjGUaeLXfWcMyTabk/edit?usp=sharing') }}" target="_blank">
            <button type="button" class="btn btn-outline-light ">Klik Untuk Lihat Senarai

            </button></a>
    </div>
</div>


<div class="container pt-4 ">
    <div class="row">
        <div class="col-6 d-flex justify-content-start">
            <p class="fw-bold fs-5">Galeri Foto KSSB</p>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="#" class="text-decoration-none">
                <p class="ebook_link">Lihat Kesemua Foto</p>
            </a>
        </div>
        <div class="row galeri-foto">
            <div class="col-6 pt-1 pb-1">
                <img src="{{URL::asset('/custom_link/galerikssb/galeri1.png')}}" class="kssb-foto img-fluid"
                    alt="kssb-foto">
            </div>
            <div class="col-6 pt-1 pb-1">
                <img src="{{URL::asset('/custom_link/galerikssb/galeri2.png')}}" class="kssb-foto img-fluid"
                    alt="kssb-foto">
            </div>
            <div class="col-6 pt-1 pb-1">
                <img src="{{URL::asset('/custom_link/galerikssb/galeri3.png')}}" class="kssb-foto  img-fluid"
                    alt="kssb-foto">
            </div>
            <div class="col-6 pt-1 pb-1">
                <img src="{{URL::asset('/custom_link/galerikssb/galeri4.png')}}" class="kssb-foto  img-fluid"
                    alt="kssb-foto">
            </div>
            <div class="col-6 pt-1 pb-1">
                <img src="{{URL::asset('/custom_link/galerikssb/galeri5.png')}}" class="kssb-foto  img-fluid"
                    alt="kssb-foto">
            </div>
            <div class="col-6 pt-1 pb-1">
                <img src="{{URL::asset('/custom_link/galerikssb/galeri6.png')}}" class="kssb-foto img-fluid"
                    alt="kssb-foto">
            </div>
        </div>
    </div>
</div>

<div class="container pt-4 ">
    <div class="row">
        <div class="col-6 d-flex justify-content-start">
            <p class="fw-bold fs-5">Galeri Video KSSB</p>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="#" class="text-decoration-none">
                <p class="ebook_link">Lihat Kesemua Video</p>
            </a>
        </div>
    </div>
    <div class="owl-carousel videokssb-carousel owl-theme">
        <div class="videokssb-item">
            <img src="{{URL::asset('/custom_link/galerikssb/videokssb1.png')}}" class="videokssb " alt="videokssb">
        </div>
        <div class="videokssb-item">
            <img src="{{URL::asset('/custom_link/galerikssb/videokssb2.png')}}" class="videokssb " alt="videokssb">
        </div>
        <div class="videokssb-item">
            <img src="{{URL::asset('/custom_link/galerikssb/videokssb3.png')}}" class="videokssb " alt="videokssb">
        </div>

    </div>
</div>

<div class="container p-0 ">
    <nav class="bnav">
        <a href="#" class="bnav__link--active">
            <i class="bi bi-house-door-fill nav__icon"></i>
            <span class="nav__text">UTAMA</span>
        </a>
        <a href="#" class="bnav__link">
            <i class="bi bi-box2-heart-fill nav__icon"></i>
            <span class="nav__text">SUMBANG</span>
        </a>
        <a href="#" class="bnav__link">
            <i class="bi bi-map-fill nav__icon"></i>
            <span class="nav__text">LOKASI</span>
        </a>
        <a href="#" class="bnav__link">
            <i class="bi bi-pie-chart-fill nav__icon"></i>
            <span class="nav__text">MAKLUMAT</span>
        </a>
    </nav>
</div>


</div>
</div>




@endsection
