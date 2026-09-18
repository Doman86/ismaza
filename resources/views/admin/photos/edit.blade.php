@extends('layouts.admin')

@section('title', 'Edit Foto')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Galeri</p>
            <h1 class="page-title">Edit Foto</h1>
        </div>
        <div class="page-actions">
            <a href="{{ route('admin.photos.index') }}" class="btn btn-ghost">&larr; Kembali</a>
        </div>
    </header>

    <div class="admin-panel form-panel">
        <form method="POST" action="{{ route('admin.photos.update', $photo) }}" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="title">Judul Foto <span class="req">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $photo->title) }}" required maxlength="255">
                @error('title')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" maxlength="2000">{{ old('description', $photo->description) }}</textarea>
                @error('description')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label>Foto Saat Ini</label>
                <img src="{{ $photo->imageUrl() }}" alt="{{ $photo->title }}" class="image-preview">
            </div>

            <div class="field">
                <label for="image">Ganti Foto (opsional)</label>
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <span class="field-hint">Kosongkan jika tidak ingin mengganti. Format: JPG, JPEG, PNG, WEBP. Maksimal 8 MB.</span>
                @error('image')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.photos.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection
