@extends('layouts.admin')

@section('title', 'Pesan')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Kelola Konten</p>
            <h1 class="page-title">Pesan</h1>
        </div>
        <div class="page-actions">
            <a href="{{ route('admin.messages.create') }}" class="btn btn-primary">+ Pesan Baru</a>
        </div>
    </header>

    @if ($messages->isNotEmpty())
        <div class="admin-panel">
            <ul class="row-list">
                @foreach ($messages as $message)
                    <li class="row-item">
                        <div class="row-main">
                            <strong>{{ $message->title }}</strong>
                            <span>{{ \Illuminate\Support\Str::limit($message->content, 100) }}</span>
                            <time>{{ $message->created_at->translatedFormat('d M Y') }}</time>
                        </div>
                        <div class="row-actions">
                            <a href="{{ route('admin.messages.edit', $message) }}" class="btn btn-small btn-ghost">Edit</a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                                  onsubmit="return confirm('Hapus pesan &quot;{{ $message->title }}&quot;?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="pagination-wrap">{{ $messages->withQueryString()->links() }}</div>
    @else
        <div class="empty-state">
            <div class="empty-icon">&#9993;</div>
            <p>Belum ada pesan.<br>Klik "Pesan Baru" untuk menulis pesan pertama.</p>
        </div>
    @endif
@endsection
