@extends('layouts.app')

@section('title', trans('errors.not_found.title'))
@section('description', trans('errors.not_found.description'))
@section('image', asset('images/headers/errors/4k.jpg'))
@section('type', 'website')
@section('color', '#d8d8d8')

@section('body')
	<header class="error">
		<h1>@lang('errors.not_found.title')</h1>
		<div class="description">@lang('errors.not_found.description')</div>
	</header>
@endsection