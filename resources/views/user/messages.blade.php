@extends('layouts.app')

@section('title', 'Pesan · For Ismaza')

@section('content')
    <section class="section page-head">
        <div class="section-inner narrow">
            <div class="ornament reveal">&#10084;</div>
            <p class="section-eyebrow reveal">kata-kata yang disimpan untukmu</p>
            <h1 class="page-title reveal" style="--d: 120ms">Pesan untuk {{ $ismazaName }}</h1>
        </div>
    </section>

    <section class="section" style="padding-top: 20px">
        <div class="section-inner narrow">
            @if ($messages->isNotEmpty())
                <div class="message-list">
                    @foreach ($messages as $message)
                        @include('partials.message-card', ['message' => $message, 'idx' => $loop->index])
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <div class="empty-icon">&#9993;</div>
                    <p>Belum ada pesan. Pesan-pesan akan muncul di sini.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
