<article class="post-card card mb-3">

    <!-- image -->
    <a href="/{{ $post->slug }}" class="img-container" 
        style="background-image:url('{{ $post->image }}')">
    </a>

    <!-- content -->
    <div class="card-content">

        <!-- title -->
        <h2><a href="/{{ $post->slug }}" > {{ $post->title }} </a></h2>

        <!-- byline -->
        <div class="byline">
            {{$post->author->name}}
        </div>

        <!-- excerpt -->
        <p>
            {{ $post->getExcerpt() }}
        </p>

        <!-- free or premium? -->
        <span class="price {{ $post->isPremium ? 'price-premium' : 'price-free'}}" > 
            {{ $post->isPremium ? 'Premium' : 'Free' }}
        </span>

    </div>

</article>