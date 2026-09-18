@extends('layouts.app')

@section('title', $siteTitle)

@section('content')
    {{-- HERO — panggung velvet --}}
    <section class="hero">
        <div class="hero-inner">
            <p class="hero-eyebrow reveal">sebuah halaman kecil, dibuat khusus</p>
            <h1 class="hero-title" data-split>{{ $heroTitle }}</h1>
            <p class="hero-subtitle reveal" style="--d: 500ms">{{ $heroSubtitle }}</p>
            <p class="hero-name reveal-scale" style="--d: 650ms">{{ $ismazaName }}</p>

            @if ($sinceDate)
                <p class="hero-date reveal" style="--d: 750ms">sejak {{ $sinceDate->locale('id')->translatedFormat('d F Y') }}</p>
            @endif

            <div class="hero-actions reveal" style="--d: 850ms">
                <a href="#gallery" class="btn btn-gold">Lihat Galeri</a>
                <a href="#messages" class="btn btn-glass">Baca Pesan</a>
            </div>
        </div>
        <div class="hero-scroll" aria-hidden="true"></div>
    </section>

    {{-- PESAN PEMBUKA --}}
    @if ($messages->isNotEmpty())
        <section class="section opening-message">
            <div class="section-inner narrow">
                <div class="ornament reveal">&#10084;</div>
                <p class="section-eyebrow reveal">pesan pembuka</p>
                <blockquote class="opening-quote reveal" style="--d: 150ms">
                    {{ $messages->first()->content }}
                </blockquote>
                <p class="opening-title reveal" style="--d: 280ms">{{ $messages->first()->title }}</p>

                {{-- Statistik cinta --}}
                <div class="stats-band">
                    <div class="stat reveal-scale" style="--d: 100ms">
                        <span class="stat-num" data-count="{{ $photos->count() }}">0</span>
                        <span class="stat-label">Momen Tersimpan</span>
                    </div>
                    <div class="stat reveal-scale" style="--d: 220ms">
                        <span class="stat-num" data-count="{{ $messages->count() }}">0</span>
                        <span class="stat-label">Pesan Untukmu</span>
                    </div>
                    @if ($sinceDate)
                        <div class="stat reveal-scale" style="--d: 340ms">
                            <span class="stat-num" data-count="{{ $daysTogether }}">0</span>
                            <span class="stat-label">Hari Bersama</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- GALERI --}}
    <section class="section" id="gallery">
        <div class="section-inner">
            <div class="section-head">
                <div>
                    <p class="section-eyebrow reveal">setiap foto punya cerita</p>
                    <h2 class="section-title reveal" style="--d: 120ms">{{ $galleryTitle }}</h2>
                </div>
                @if ($photos->count() > 6)
                    <a href="{{ route('gallery') }}" class="section-link reveal">Lihat semua &rarr;</a>
                @endif
            </div>

            @if ($photos->isNotEmpty())
                <div class="gallery-grid">
                    @foreach ($photos->take(6) as $photo)
                        @include('partials.photo-card', ['photo' => $photo, 'idx' => $loop->index])
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <div class="empty-icon">&#128247;</div>
                    <p>Belum ada foto di sini.<br>Galeri akan terisi setelah foto diupload.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- PESAN KHUSUS --}}
    <section class="section section-soft" id="messages">
        <div class="section-inner">
            <div class="section-head">
                <div>
                    <p class="section-eyebrow reveal">kata-kata yang disimpan</p>
                    <h2 class="section-title reveal" style="--d: 120ms">Pesan <em>Khusus</em></h2>
                </div>
            </div>

            @if ($messages->count() > 1)
                <div class="message-grid">
                    @foreach ($messages->skip(1) as $message)
                        @include('partials.message-card', ['message' => $message, 'idx' => $loop->index])
                    @endforeach
                </div>
            @elseif ($messages->isNotEmpty())
                <div class="empty-state reveal">
                    <p>Pesan pertamamu sudah tampil di atas. Pesan lainnya akan muncul di sini.</p>
                </div>
            @else
                <div class="empty-state reveal">
                    <div class="empty-icon">&#9993;</div>
                    <p>Belum ada pesan. Pesan-pesan akan muncul di sini.</p>
                </div>
            @endif

            <div class="section-cta reveal">
                <a href="{{ route('messages') }}" class="btn btn-ghost">Semua pesan &rarr;</a>
            </div>
        </div>
    </section>

    {{-- CLOSING --}}
    <section class="closing">
        <div class="section-inner narrow">
            <div class="closing-mark reveal">&#10084;</div>
            <p class="closing-text reveal" style="--d: 150ms">{{ $closingText }}</p>
            <p class="closing-sign reveal-scale" style="--d: 350ms">{{ $ismazaName }}</p>
        </div>
    </section>

    @include('partials.lightbox')
@endsection
