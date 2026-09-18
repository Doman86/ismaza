@if (session('success'))
    <div class="flash flash-success" role="status">
        <span>{{ session('success') }}</span>
        <button type="button" class="flash-close" aria-label="Tutup">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class="flash flash-error" role="alert">
        <span>{{ session('error') }}</span>
        <button type="button" class="flash-close" aria-label="Tutup">&times;</button>
    </div>
@endif

@if ($errors->any())
    <div class="flash flash-error" role="alert">
        <strong>Periksa kembali isian berikut:</strong>
        <ul class="flash-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="flash-close" aria-label="Tutup">&times;</button>
    </div>
@endif
