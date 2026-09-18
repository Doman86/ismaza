@extends('layouts.admin')

@section('title', 'Foto')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Kelola Galeri</p>
            <h1 class="page-title">Foto</h1>
        </div>
        <div class="page-actions">
            <a href="{{ route('admin.photos.create') }}" class="btn btn-primary">+ Upload Foto</a>
        </div>
    </header>

    @if ($photos->isNotEmpty())
        <div class="admin-photo-grid">
            @foreach ($photos as $photo)
                <div class="admin-photo-card">
                    <div class="admin-photo-img">
                        <img src="{{ $photo->imageUrl() }}" alt="{{ $photo->title }}" loading="lazy">
                    </div>
                    <div class="admin-photo-body">
                        <h3>{{ $photo->title }}</h3>
                        @if ($photo->description)
                            <p>{{ \Illuminate\Support\Str::limit($photo->description, 80) }}</p>
                        @endif
                        <span class="admin-photo-date">{{ $photo->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="admin-photo-actions">
                        <a href="{{ route('admin.photos.edit', $photo) }}" class="btn btn-small btn-ghost">Edit</a>
                        <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}"
                              onsubmit="return confirm('Hapus foto &quot;{{ $photo->title }}&quot;? File juga akan dihapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrap">{{ $photos->withQueryString()->links() }}</div>
    @else
        <div class="empty-state">
            <div class="empty-icon">&#128247;</div>
            <p>Belum ada foto.<br>Klik "Upload Foto" untuk menambahkan foto pertama.</p>
        </div>
    @endif
@endsection
