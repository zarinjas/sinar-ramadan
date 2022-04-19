require('./bootstrap');
import svgPanZoom, { center } from 'svg-pan-zoom';
import {
    Splide
} from '@splidejs/splide';
import 'owl.carousel';
import lightGallery from 'lightgallery';
import lgVideo from 'lightgallery/plugins/video';

if (document.querySelector(".utama-page")) {

    var headerSplide = new Splide('#headerSplide', {
        type: 'loop',
        arrows: false,
        autoplay: true,
        pauseOnHover: true,
    });
    headerSplide.mount();


    $(".top-card-container").owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        dotsEach: true,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        },
    });
    $(".ebook-outsource-carousel").owlCarousel({
        loop: false,
        margin: 10,
        autoplay: true,
        rewind: true,
        dots: false,
        autoHeight: true
    });

    $(".ebook-abim-carousel").owlCarousel({
        loop: false,
        margin: 10,
        dots: true,
        dotsEach: true,
        autoHeight: true
    });

    lightGallery(document.getElementById('outSourcePdf'), {
        selector: '.ebook-pdf',
    });

    lightGallery(document.getElementById('abimPdf'), {
        selector: '.ebook-pdf',
    });

    $(".kssb-negeri-container").owlCarousel({
        loop: false,
        margin: 10,
        autoplay: false,
        dots: false,
        autoWidth: true,
    });

    $(".penganjur-carousel").owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        dotsEach: true,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 5,
            },
            600: {
                items: 4,
            },
            1000: {
                items: 4,
            },
        },
    });

    lightGallery(document.getElementById('lg-galeri-foto'), {
        // plugins: [lgZoom, lgThumbnail],
        speed: 500,
        selector: '.lg-foto-item',
    });

    //map
    var states = $('.state');
    var mapModalOverlay = $('.map-modal-container');
    var mapCard = $('.map-card-container');

    states.each(function() {
        $(this).click(function() {
            mapModalOverlay.addClass('show');
            // mapCard.addClass('show');
            $('body').addClass('overflow-hidden');
        })
    });

    mapModalOverlay.click(function() {
        mapModalOverlay.removeClass('show');
        mapCard.removeClass('show');
        $('body').removeClass('overflow-hidden');
    });

    $('.map-card-button').click(function(e) {
        e.preventDefault;
        mapModalOverlay.removeClass('show');
        mapCard.removeClass('show');
        $('body').removeClass('overflow-hidden');
    });

    //map card
    document.addEventListener('livewire:load', function () {
        window.Livewire.hook('message.processed', (message, component) => {
            var splide = new Splide('.tab-splide', {
                pagination: false,
                perMove: 1,
                perPage: 1,
                autoWidth: true,
                rewind: true,
                trimSpace: false,
                arrows: false,
            });
            splide.mount();
        });
    });



    //zoom
    var malaysiaMapZoom = svgPanZoom('#malaysiaMap', {
        zoomEnabled: true,
        controlIconsEnabled: false,
        preventMouseEventsDefault: false,
        dblClickZoomEnabled: false,
        mouseWheelZoomEnabled: false,
        minZoom: 0.7,       
        maxZoom: 10
    });

    $('.zoom-in').on('click', function () {
        malaysiaMapZoom.zoomIn();
    });

    $('.zoom-out').on('click', function () {
        malaysiaMapZoom.zoomOut();
    });

    //kssb video gallery
    lightGallery(document.getElementById('kssb-gallery-videos'), {
        speed: 500,
        selector: '.video-wrapper',
        plugins: [lgVideo],
    });

    $('.kssb-video-carousel').owlCarousel({
        loop: false,
        margin: 10,
        autoplay: true,
        rewind: true,
        dots: true,
        dotsEach: true,
        items: 1,
        autoplayHoverPause: true,
        autoWidth: true
    });

    //tanwir video gallery
    lightGallery(document.getElementById('tanwir-gallery-videos'), {
        speed: 500,
        selector: '.video-wrapper',
        plugins: [lgVideo],
    });

    $('.tanwir-video-carousel').owlCarousel({
        loop: false,
        margin: 10,
        autoplay: true,
        rewind: true,
        dots: true,
        dotsEach: true,
        items: 1,
        autoplayHoverPause: true,
        autoWidth: true
    });

    $(".projek-carousel").owlCarousel({
        loop: false,
        margin: 10,
        autoplay: true,
        rewind: true,
        dots: false,
        autoWidth: true,
        selector: '.projek-item'
    });

    lightGallery(document.getElementById('hadisContainer'), {
        speed: 500,
        selector: '.hadis-item',
    });

    lightGallery(document.getElementById('projekContainer'), {
        speed: 500,
        selector: '.projek-item',
    });
}

if (document.querySelector(".gallery-page")) {
    //gallery page
    lightGallery(document.getElementById('programContainer'), {
        speed: 500,
        selector: '.program-item',
    });
}

if (document.querySelector(".video-page")) {
    //video page
    lightGallery(document.getElementById('programContainer'), {
        speed: 500,
        selector: '.video-wrapper',
        plugins: [lgVideo],
    });
}

if (document.querySelector(".book-page")) {
    //book page
    lightGallery(document.getElementById('bookContainer'), {
        selector: '.ebook-pdf',
    });
}