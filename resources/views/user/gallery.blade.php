@extends('layouts.app')

@section('title', $galleryTitle . ' · For Ismaza')

@section('content')
    <section class="section page-head">
        <div class="section-inner narrow">
            <div class="ornament reveal">&#10084;</div>
            <p class="section-eyebrow reveal">setiap foto punya cerita</p>
            <h1 class="page-title reveal" style="--d: 120ms">{{ $galleryTitle }}</h1>
        </div>
    </section>

    <section class="section" style="padding-top: 20px">
        <div class="section-inner">
            @if ($photos->isNotEmpty())
                <div class="gallery-grid">
                    @foreach ($photos as $photo)
                        @include('partials.photo-card', ['photo' => $photo, 'idx' => $loop->index])
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <div class="empty-icon">&#128247;</div>
                    <p>Belum ada foto.<br>Foto akan muncul di sini setelah diupload melalui dashboard admin.</p>
                </div>
            @endif
        </div>
    </section>

    @include('partials.lightbox')
@endsection
