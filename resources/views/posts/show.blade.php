@extends('layouts.base')
@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)
@push('styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
@endpush
@section('content')
<article class="post container">
    @if ($post->photos->count() === 1)
        @include('posts.photo')
    @elseif($post->photos->count() > 1)
        @include('posts.carousel')
    @elseif($post->iframe)
        @include('posts.iframe')
    @endif
    <div class="content-post">
      @include('posts.header')
        <h1>{{$post->title}}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
          {!!$post->body!!}
        </div>

        <footer class="container-flex space-between">
            @include('partials.social-links', ['description' => $post->title])
            @include('posts.tags')
        </footer>
        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
                @include('partials.disqus-script')
        </div><!-- .comments -->
    </div>
  </article>
@endsection
@push('scripts')
    <script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endpush
