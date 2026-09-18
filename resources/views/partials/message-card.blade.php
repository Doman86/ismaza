<article class="message-card reveal" style="--d: {{ $idx ?? 0 * 80 }}ms">
    <h3 class="message-title">{{ $message->title }}</h3>
    <p class="message-body">{{ $message->content }}</p>
    <time class="message-date">{{ $message->created_at->translatedFormat('d F Y') }}</time>
</article>
