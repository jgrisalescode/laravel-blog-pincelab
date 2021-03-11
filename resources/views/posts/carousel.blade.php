<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($post->photos as $photo)
            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                <img src="{{asset('/storage/'.$photo->url)}}" alt="">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
