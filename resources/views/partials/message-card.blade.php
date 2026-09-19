@php
    $idx = $idx ?? 0;
@endphp

<article class="message-card reveal" style="--d: {{ $idx * 80 }}ms">
    <h3 class="message-title">{{ $message->title }}</h3>
    <p class="message-body">{{ $message->content }}</p>
    <time class="message-date" datetime="{{ $message->created_at->toIso8601String() }}">{{ $message->created_at->translatedFormat('d F Y') }}</time>
</article>
