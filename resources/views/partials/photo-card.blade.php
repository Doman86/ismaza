@php
    $idx = $idx ?? 0;
@endphp

<figure class="photo-card reveal" style="--d: {{ $idx * 60 }}ms">
    <button
        type="button"
        class="photo-card-btn"
        data-lightbox-trigger
        data-title="{{ $photo->title }}"
        data-description="{{ $photo->description }}"
        data-src="{{ $photo->imageUrl() }}"
    >
        <img src="{{ $photo->imageUrl() }}" alt="{{ $photo->title }}" loading="lazy">
    </button>
    <figcaption class="photo-card-caption">
        <span class="photo-card-title">{{ $photo->title }}</span>
        @if ($photo->description)
            <span class="photo-card-desc">{{ \Illuminate\Support\Str::limit($photo->description, 60) }}</span>
        @endif
    </figcaption>
</figure>
