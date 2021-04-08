@extends('layouts.base')
@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)
@push('styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
@endpush
@section('content')
<article class="post container">
    @if ($post->photos->count() === 1)
        <figure>
            <img src="{{ asset('/storage/'.$post->photos->first()->url) }}" alt="" class="img-responsive">
        </figure>
    @elseif($post->photos->count() > 1)
        @include('posts.carousel')
    @elseif($post->iframe)
        <div class="video">
            {!! $post->iframe !!}
        </div>
    @endif
    <div class="content-post">
      <header class="container-flex space-between">
        <div class="date">
            <span class="c-gris">{{optional($post->published_at)->format('M d')}}</span>
        </div>
        @if($post->category)
            <div class="post-category">
                <span class="category">{{$post->category->name}}</span>
            </div>
        @endif
      </header>
        <h1>{{$post->title}}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
          {!!$post->body!!}
        </div>

        <footer class="container-flex space-between">
          @include('partials.social-links', ['description' => $post->title])
          <div class="tags container-flex">
            @foreach ($post->tags as $tag)
                <span class="tag c-gris">#{{$tag->name}}</span>
            @endforeach
          </div>
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
