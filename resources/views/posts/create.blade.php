@extends('layouts.main')

@section('content')

    <form action=" {{ route('posts.store') }} " method="POST" >
        @csrf
        <label for="title">Titolo : </label>
        <input type="text" name="title_in" class="@error('title_in') is-invalid @enderror" value="{{old('title_in')}}">
        @error('title_in')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <label for="author">Autore : </label>
        <input type="text" name="author_in" class="@error('author_in') is-invalid @enderror" value="{{old('author_in')}}">
        @error('author_in')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <label for="category">Categoria : </label>
        <select name="category_in" class="@error('category_in') is-invalid @enderror">
            <option value="">---</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" {{old('category_in')==$category->id ? 'selected' : ''}}>{{$category->title}}</option>
            @endforeach
        </select>
        @error('category_in')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <label for="description">Descrizione : </label>
        <input type="text" name="description_in" class="@error('description_in') is-invalid @enderror" value="{{old('description_in')}}">
        @error('description_in')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <fieldset>
            <legend>Selezione i tags</legend>
            @foreach($tags as $tag)
                <div>
                    <input type="checkbox" id="{{'chk_' . $tag->name}}" name="tags_in[]" value="{{ $tag->id }}" 
                           class="@error('tags_in[]') is-invalid @enderror" 
                           @if( is_array(old('tags_in')) && in_array($tag->id, old('tags_in')))
                            checked 
                           @endif>
                    <label for="{{'chk_' . $tag->name}}">{{$tag->name}}</label>
                </div>
            @endforeach
        </fieldset>
        @error('tags_in[]')
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <button type="submit">Crea Post</button>

    </form>

@endsection