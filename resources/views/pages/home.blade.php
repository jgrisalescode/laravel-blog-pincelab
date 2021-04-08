@extends('layouts.base')

@section('content')
<section class="posts container">
    @isset($category)
        <h3>Posts de la categoría {{$category->name}}</h3>
    @endisset
    @foreach($posts as $post)
    <article class="post">
        @if ($post->photos->count() === 1)
            @include('posts.photo')
        @elseif($post->photos->count() > 1)
            @include('posts.carousel-preview')
        @elseif($post->iframe)
            @include('posts.iframe')
        @endif
        <div class="content-post">
            @include('posts.header')
            <h1>{{$post->title}}</h1>
            <div class="divider"></div>
            <p>{{$post->excerpt}}</p>
            <footer class="container-flex space-between">
                <div class="read-more">
                    <a href="{{route('posts.show', $post)}}" class="text-uppercase c-green">Leer más</a>
                </div>
                @include('posts.tags')
            </footer>
        </div>
    </article>
    @endforeach
</section>
<!-- fin del div.posts.container -->
{{$posts->links('vendor.pagination.default')}}
@endsection

