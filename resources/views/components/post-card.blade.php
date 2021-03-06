<article class="card shadow-sm mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-9 col-lg-10 pt-2">
        <h5 class="card-title">{{ $post->title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted small">{{ to_persian_digits(verta($post->created_at)) }}</h6>
        <h6 class="card-subtitle mb-2 text-muted small">{{ __('در') }} <a class="text-body hover-underline" href="{{ route('community.show', ['community' => $post->community->id]) }}">{{ $post->community->name }}</a>{{ __('،') }} {{ __('توسط') }} <a class="text-body hover-underline" href="#"> {{ $post->user->username }}</a></h6>
      </div>
    </div>
    {!! $post->rendered_body !!}
  </div>
  <div class="card-footer bg-body">
    <div class="float-start pt-1">
      <i class="fas fa-comments"></i> {{ to_persian_digits($post->comments_count) }}
      <span class="mx-1"></span>
      @auth
      <button type="button" class="btn btn-{{ $post->dislikes()->whereUserId(auth()->user()->id)->exists() ? '' : 'outline-' }}dark btn-dislike" data-postid="{{ $post->id }}"><i class="fas fa-thumbs-down"></i> <span id="dislikes-count-{{ $post->id }}">{{ to_persian_digits($post->dislikes_count) }}</span></button>
      <button type="button" class="btn btn-{{ $post->likes()->whereUserId(auth()->user()->id)->exists() ? '' : 'outline-' }}dark btn-like" data-postid="{{ $post->id }}"><i class="fas fa-thumbs-up"></i> <span id="likes-count-{{ $post->id }}">{{ to_persian_digits($post->likes_count) }}</span></button>
      @endauth
      @guest
      <i class="fas fa-thumbs-down"></i> {{ to_persian_digits($post->dislikes_count) }}
      <span class="mx-1"></span>
      <i class="fas fa-thumbs-up"></i> {{ to_persian_digits($post->likes_count) }}
      @endguest
    </div>
    <div class="float-end">
      <a href="{{ route('post.bookmark', ['post' => $post->id]) }}" class="btn btn-{{ (auth()->check() && $post->savedPosts()->whereUserId(auth()->user()->id)->exists()) ? '' : 'outline-' }}dark"><i class="far fa-bookmark"></i></a>
      <a href="{{ route('post.report', ['post' => $post->id]) }}" class="btn btn-{{ (auth()->check() && $post->reports()->whereUserId(auth()->user()->id)->exists()) ? '' : 'outline-' }}dark"><i class="far fa-exclamation-triangle"></i> @if (auth()->check() && $post->community->admins()->whereUserId(auth()->user()->id)->exists()){{ to_persian_digits($post->reports_count) }}@endif</a>
    </div>
  </div>
</article>