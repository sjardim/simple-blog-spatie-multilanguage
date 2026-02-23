@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    
    <p>
        {{-- Returns current url with English locale. --}}
        {{ LaravelLocalization::getLocalizedURL('en') }}
    </p>
    <p>
        {{-- Returns current url with Portuguese locale. --}}
        {{ LaravelLocalization::getLocalizedURL('pt') }}
    </p>
@endsection