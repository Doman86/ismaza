@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
    <header class="page-header">
        <div>
            <p class="page-eyebrow">Konten Website</p>
            <h1 class="page-title">Pengaturan</h1>
        </div>
    </header>

    <div class="admin-panel form-panel">
        <p class="panel-note">
            Ubah semua teks yang tampil di halaman Ismaza di sini &mdash; tanpa perlu menyentuh kode.
        </p>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="form">
            @csrf
            @method('PUT')

            @foreach ($settings as $key => $item)
                <div class="field">
                    <label for="settings-{{ $key }}">{{ $item['label'] }}</label>

                    @if ($key === 'closing_text' || $key === 'hero_subtitle')
                        <textarea id="settings-{{ $key }}" name="settings[{{ $key }}]" rows="3" maxlength="1000">{{ old('settings.' . $key, $item['value']) }}</textarea>
                    @elseif ($key === 'since_date')
                        <input type="date" id="settings-{{ $key }}" name="settings[{{ $key }}]" value="{{ old('settings.' . $key, $item['value']) }}">
                    @else
                        <input type="text" id="settings-{{ $key }}" name="settings[{{ $key }}]" value="{{ old('settings.' . $key, $item['value']) }}" maxlength="255">
                    @endif

                    <span class="field-hint">Default: {{ $item['default'] }}</span>
                </div>
            @endforeach

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
