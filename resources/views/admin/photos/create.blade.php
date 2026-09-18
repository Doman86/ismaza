@extends('layouts.admin')

@section('title', 'Upload Foto')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Galeri</p>
            <h1 class="page-title">Upload Foto</h1>
        </div>
        <div class="page-actions">
            <a href="{{ route('admin.photos.index') }}" class="btn btn-ghost">&larr; Kembali</a>
        </div>
    </header>

    <div class="admin-panel form-panel">
        <form method="POST" action="{{ route('admin.photos.store') }}" enctype="multipart/form-data" class="form">
            @csrf

            <div class="field">
                <label for="title">Judul Foto <span class="req">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255" placeholder="mis: Kenangan pertama">
                @error('title')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" maxlength="2000" placeholder="Cerita singkat tentang foto ini...">{{ old('description') }}</textarea>
                @error('description')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="image">Pilih Foto <span class="req">*</span></label>
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required>
                <span class="field-hint">Format: JPG, JPEG, PNG, WEBP. Maksimal 8 MB.</span>
                @error('image')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Pratinjau langsung saat memilih file --}}
            <div class="field">
                <img id="imagePreview" src="" alt="" class="image-preview" hidden>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Upload</button>
                <a href="{{ route('admin.photos.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('image');
            var preview = document.getElementById('imagePreview');
            if (input && preview) {
                input.addEventListener('change', function () {
                    var file = input.files && input.files[0];
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.hidden = false;
                    } else {
                        preview.hidden = true;
                    }
                });
            }
        });
    </script>
@endpush
