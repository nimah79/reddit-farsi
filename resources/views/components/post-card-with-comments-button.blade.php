<article class="card shadow-sm mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-9 col-lg-10 pt-2">
        <h5 class="card-title"><a href="{{ route('post.show', ['post' => $post->id]) }}" class="text-body">{{ $post->title }}</a></h5>
        <h6 class="card-subtitle mb-2 text-muted small">{{ to_persian_digits(verta($post->created_at)) }}</h6>
        <h6 class="card-subtitle mb-2 text-muted small">{{ __('در') }} <a class="text-body hover-underline" href="#">{{ $post->community->name }}</a>{{ __('،') }} {{ __('توسط') }} <a class="text-body hover-underline" href="#"> {{ $post->user->username }}</a></h6>
      </div>
    </div>
    {!! $post->rendered_body !!}
  </div>
  <div class="card-footer bg-body">
    <div class="float-start pt-1">
      <i class="fas fa-comments"></i> {{ to_persian_digits($post->comments_count) }}
      <span class="mx-1"></span>
      @auth
      <button type="button" class="btn btn-outline-dark"><i class="fas fa-thumbs-down"></i> {{ to_persian_digits($post->dislikes_count) }}</button>
      <button type="button" class="btn btn-dark"><i class="fas fa-thumbs-up"></i> {{ to_persian_digits($post->likes_count) }}</button>
      @endauth
      @guest
      <i class="fas fa-thumbs-down"></i> {{ to_persian_digits($post->dislikes_count) }}
      <span class="mx-1"></span>
      <i class="fas fa-thumbs-up"></i> {{ to_persian_digits($post->likes_count) }}
      @endguest
    </div>
    <div class="float-end">
      <a href="{{ route('post.show', ['post' => $post->id]) }}" class="btn btn-dark">{{ __('مشاهدهٔ دیدگاه‌ها') }}</a>
    </div>
  </div>
</article>