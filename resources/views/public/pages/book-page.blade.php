@extends('public.layouts.page')

@section('content')
<section id="book-page" class="book-page mb-3">
    <div class="container">
        <div class="title mb-3">
            <h1 class="fw-semibold fs-4">{{ $category->category_name }}</h1>
        </div>
        <div class="row g-3 px-3" id="bookContainer">
            @foreach ($books as $book)
            <div class="col-6">
                @if ($book->is_redirect)
                <div class="ebook-item">
                    <a class="ebook" href="{{ $book->book_url }}">
                        <img src="{{ $book->thumbnail->relativeUrl }}"  class="img-fluid w-100 h-100 shadow" alt="{{ $book->book_name }}">
                        <div class="read-overlay"><i class="bi bi-book"></i></div>
                    </a>
                </div>
                @else
                <div class="ebook-item">
                    <a class="ebook ebook-pdf c-pointer" data-src="{{ $book->pdf->url }}" data-iframe="true">
                        <img src="{{ $book->thumbnail->relativeUrl }}"  class="img-fluid w-100 h-100 shadow" alt="{{ $book->book_name }}">
                        <div class="read-overlay"><i class="bi bi-book"></i></div>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection