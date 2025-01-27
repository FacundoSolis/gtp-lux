@extends('layouts.app')

@section('meta')
    <title>{{ $meta_title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
@endsection

@section('content')
    <div class="dynamic-content">
        {!! $section->content !!} <!-- Renderizar contenido dinámico -->
    </div>
@endsection
