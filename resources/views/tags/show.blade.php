@extends('layouts.main')

@section('content')

    <h1>{{$tag->title}}</h1>

    <ul>
        @foreach($tag->posts as $post)
            <li>
                {{$post->title}}
            </li>
        @endforeach
    </ul>
    

@endsection