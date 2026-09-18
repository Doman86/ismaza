@extends('layouts.admin')

@section('title', 'Pesan Baru')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Konten</p>
            <h1 class="page-title">Tulis Pesan</h1>
        </div>
        <div class="page-actions">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost">&larr; Kembali</a>
        </div>
    </header>

    <div class="admin-panel form-panel">
        <form method="POST" action="{{ route('admin.messages.store') }}" class="form">
            @csrf

            <div class="field">
                <label for="title">Judul <span class="req">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255" placeholder="mis: Untuk Ismaza">
                @error('title')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="content">Isi Pesan <span class="req">*</span></label>
                <textarea id="content" name="content" rows="6" required maxlength="5000" placeholder="Tulis pesanmu di sini...">{{ old('content') }}</textarea>
                @error('content')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection
