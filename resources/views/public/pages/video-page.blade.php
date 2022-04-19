@extends('public.layouts.page')

@section('content')
<section id="video-page" class="video-page mb-3">
    <div class="container">
        <div class="title mb-3">
            <h1 class="fw-semibold fs-4">{{ $program->program_title }}</h1>
        </div>
        <div class="row g-2" id="programContainer">
            @foreach ($program->gallery->videos as $video)
            <div class="col-12 col-sm-6">
                <div class="video-item w-100">
                    <a class="video-wrapper text-decoration-none" data-lg-size="1280-720" data-src="//www.youtube.com/watch?v={{ $video->youtube_id }}"
                        data-poster="{{ ($video->video_thumbnail) ? $video->thumbnail->relativeUrl : 'https://img.youtube.com/vi/' . $video->youtube_id . '/maxresdefault.jpg'}}"
                        data-sub-html="<h4 class='mb-5'>{{ $video->video_name }}</h4>">
                        <img class="img-responsive img-fluid img-cover" alt="{{ $video->video_name }}"
                        src="{{ ($video->video_thumbnail) ? $video->thumbnail->relativeUrl : 'https://img.youtube.com/vi/' . $video->youtube_id . '/maxresdefault.jpg'}}" />
                        <div class="play-overlay"><i class="bi bi-play-circle"></i></div>
                        <div class="title-overlay fs-5 p-3 text-white fw-semibold lh-1">{{ \Illuminate\Support\Str::limit($video->video_name, 60, '...') }}</div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection