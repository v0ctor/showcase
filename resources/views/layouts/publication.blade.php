@extends('layouts.app')

@section('type', 'article')

@push('opengraph')
    <meta property="article:author" content="https://facebook.com/victordzmr">
    <meta property="article:published_time" content="@yield('date_iso')">
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/publications.css?' . config('app.build')) }}">
@endpush

@push('scripts')
    <script src="{{ asset('scripts/publications.js?' . config('app.build')) }}"></script>
@endpush

@section('body')
    <div class="publication">
        <header class="@yield('publication')">
            <h1>@yield('title')</h1>

            <div class="author"><a href="{{ url('/') }}">@lang('app.author.full_name')</a></div>
            <time class="date">@yield('date_human')</time>

            <div id="scroll" class="arrow"></div>
            <div class="web"><a href="https://victordiaz.me">victordiaz.me</a></div>
        </header>
        @yield('content')
    </div>
@endsection
