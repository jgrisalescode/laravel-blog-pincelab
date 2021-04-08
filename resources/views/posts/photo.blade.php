<figure>
    <img src="{{ asset('/storage/'.$post->photos->first()->url) }}"
         alt="Photo: {{$post->title}}"
         class="img-responsive"
    >
</figure>
