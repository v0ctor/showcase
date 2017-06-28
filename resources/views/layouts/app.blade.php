<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		<title>@yield('title')</title>
		<meta charset="utf-8">
		<meta name="author" content="@lang('app.title')">
		<meta name="description" content="@lang('app.description', ['age' => Carbon::createFromDate(1994, 1, 31)->age])">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@foreach (array_diff(config('app.locales'), [App::getLocale()]) as $language)
			<link rel="alternate" hreflang="{{ $language }}" href="{{ url()->current() }}?hl={{ $language }}">
		@endforeach
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<script src="{{ asset('js/app.js') }}"></script>
		<meta name="theme-color" content="#181830">
		<link rel="manifest" href="{{ asset('manifest.json') }}">
		<meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icons/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icons/favicon-16x16.png') }}">
		<link rel="mask-icon" href="{{ asset('images/icons/safari-pinned-tab.svg') }}" color="#181830">
		<link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}">
	</head>
	<body>
		@yield('body')
		@include('inc.analytics')
	</body>
</html>