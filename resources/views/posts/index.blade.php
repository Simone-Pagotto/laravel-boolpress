@extends('layouts.main')
    <h1>POSTS</h1>
@section('content')
    @auth
        <a href="{{route('posts.create')}}">Crea nuovo Post</a>
    @endauth
    <table>
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th>{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <th>
                        <a href="{{ route('posts.show',$post->id) }}">{{$post->id}}</a>   
                    </th>
                    <th>
                        {{$post->title}}
                    </th>
                    <th>
                        {{$post->category->title}}
                    </th>
                    <th>
                        @if($post->postInformation != null)
                         {{$post->postInformation->description}}
                        @else 
                            no description available
                        @endif
                        {{-- {{$post->postInformation->description??'no description available'}} --}}
                    </th>
                    <th>
                        @foreach($post->tags as $tag)
                            <a>{{$tag->name}}</a>
                            <br>
                        @endforeach
                    </th>
                    @auth
                    <th>
                        <a href="{{route('posts.edit',$post->id)}}">Aggiorna</a>
                    </th>
                    <th>
                        <form action="{{route('posts.destroy',$post)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancella</button>
                        </form>
                        
                    </th>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{$posts->links()}}</div>
@endsection