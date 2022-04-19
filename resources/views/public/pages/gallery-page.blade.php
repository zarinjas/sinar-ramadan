@extends('public.layouts.page')

@section('content')
<section id="gallery-page" class="gallery-page mb-3">
    <div class="container">
        <div class="title mb-3">
            <h1 class="fw-semibold fs-4">{{ $program->program_title }}</h1>
        </div>
        <div class="row g-2" id="programContainer">
            @foreach ($program->gallery->attachment as $image)
            <div class="col-6">
                <a class="program-item {{ $program->program_slug }}" href="{{ $image->relativeUrl }}">
                    <div class="foto-img-container">
                        <img src="{{ $image->relativeUrl }}" class="img-cover img-fluid"
                            alt="{{ $image->original_name }}">
                        <div class="zoom-overlay"><i class="bi bi-search"></i></div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection