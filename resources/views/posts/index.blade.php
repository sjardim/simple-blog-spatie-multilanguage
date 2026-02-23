@extends('layouts.app')

@section('title', __('Posts'))

@section('content')
    <h1>{{ __('Posts') }}</h1>
    <p>{{ __('Here are all the posts in the blog.') }}</p>
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection