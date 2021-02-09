@extends('layouts.main')

@section('content')

    <div>
        <p>{{$post->title}}</p>
        <p>{{$post->category->title}}</p>
        <p>{{$post->postInformation->description}}</p>
    </div>

@endsection