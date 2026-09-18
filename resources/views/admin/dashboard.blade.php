@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Dashboard</p>
            <h1 class="page-title">Selamat datang, Admin</h1>
        </div>
        <div class="page-actions">
            <a href="{{ route('admin.photos.create') }}" class="btn btn-primary">+ Upload Foto</a>
            <a href="{{ route('admin.messages.create') }}" class="btn btn-ghost">+ Pesan Baru</a>
        </div>
    </header>

    {{-- Statistik --}}
    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-label">Total Foto</span>
            <span class="stat-value">{{ $totalPhotos }}</span>
            <a href="{{ route('admin.photos.index') }}" class="stat-link">Kelola foto &rarr;</a>
        </div>
        <div class="stat-card">
            <span class="stat-label">Total Pesan</span>
            <span class="stat-value">{{ $totalMessages }}</span>
            <a href="{{ route('admin.messages.index') }}" class="stat-link">Kelola pesan &rarr;</a>
        </div>
    </div>

    {{-- Terbaru --}}
    <div class="admin-columns">
        <section class="admin-panel">
            <div class="panel-head">
                <h2>Foto Terbaru</h2>
                <a href="{{ route('admin.photos.index') }}" class="panel-link">Semua</a>
            </div>

            @if ($latestPhotos->isNotEmpty())
                <div class="thumb-row">
                    @foreach ($latestPhotos as $photo)
                        <a href="{{ route('admin.photos.edit', $photo) }}" class="thumb-item" title="{{ $photo->title }}">
                            <img src="{{ $photo->imageUrl() }}" alt="{{ $photo->title }}">
                        </a>
                    @endforeach
                </div>
            @else
                <p class="empty-inline">Belum ada foto. <a href="{{ route('admin.photos.create') }}">Upload sekarang</a>.</p>
            @endif
        </section>

        <section class="admin-panel">
            <div class="panel-head">
                <h2>Pesan Terbaru</h2>
                <a href="{{ route('admin.messages.index') }}" class="panel-link">Semua</a>
            </div>

            @if ($latestMessages->isNotEmpty())
                <ul class="mini-list">
                    @foreach ($latestMessages as $message)
                        <li>
                            <a href="{{ route('admin.messages.edit', $message) }}">
                                <strong>{{ $message->title }}</strong>
                                <span>{{ \Illuminate\Support\Str::limit($message->content, 50) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="empty-inline">Belum ada pesan. <a href="{{ route('admin.messages.create') }}">Tulis pesan</a>.</p>
            @endif
        </section>
    </div>
@endsection
