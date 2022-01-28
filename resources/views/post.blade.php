@extends('layouts/header-and-footer')

@section('title', $post->title)

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="mb-2">
        <button type="button" class="btn btn-round btn-dark"><i class="fas fa-arrow-up"></i> {{ __('جدیدترین‌ها') }}</button>
        <button type="button" class="btn btn-round btn-outline-dark"><i class="fas fa-comments"></i> {{ __('پربحث‌ترین‌ها') }}</button>
        <button type="button" class="btn btn-round btn-outline-dark"><i class="fas fa-thumbs-up"></i> {{ __('محبوب‌ترین‌ها') }}</button>
      </div>

      <article class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9 col-lg-10 pt-2">
              <a href="{{ route('post.show', ['post' => $post->id]) }}" class="text-body"><h5 class="card-title">{{ $post->title }}</h5></a>
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
        </div>
      </article>

      <div class="row">
    <div class="col-12">
      <section class="comments">
        <article class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-1 col-lg-1">
              <img src="http://www.gravatar.com/avatar/ef935846c376defe94702eba88bee9ac" alt="mdo" width="50" height="50" class="rounded-circle">
            </div>
            <div class="col-9 col-lg-10 pt-2">
              <h6 class="card-subtitle mb-2 text-muted small"><a href="#" class="link-dark">نیما حیدری‌نسب</a></h6>
              <h6 class="card-subtitle mb-2 text-muted small">۱۴۰۰/۰۵/۰۸ ۱۶:۴۷</h6>
            </div>
          </div>
          {!! $post->rendered_body !!}
          <div class="float-start pt-1">
            @auth
            <button type="button" class="btn btn-outline-dark"><i class="fas fa-thumbs-down"></i> {{ to_persian_digits($post->dislikes_count) }}</button>
            <button type="button" class="btn btn-dark"><i class="fas fa-thumbs-up"></i> {{ to_persian_digits($post->likes_count) }}</button>
            <button type="button" class="btn btn-dark"><i class="fas fa-reply"></i> پاسخ دادن</button>
            @endauth
            @guest
            <i class="fas fa-thumbs-down"></i> {{ to_persian_digits($post->dislikes_count) }}
            <span class="mx-1"></span>
            <i class="fas fa-thumbs-up"></i> {{ to_persian_digits($post->likes_count) }}
            @endguest
        </div>
        </div>
        <div class="card-footer bg-body">
        </div>
      </article>
      </section>
    </div>
  </div>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 1rem;">
        <div class="card shadow-sm p-4 mb-3 bg-body rounded">
          <h4><i class="fas fa-fire"></i> {{ __('داغ‌ترین انجمن‌های امروز') }}</h4>
          <p class="mb-0">انجمن شاعران مرده</p>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('scripts')
@parent
<script>
$(document).ready(function(){
  $(".reply-popup").click(function(){
    $(".reply-box").toggle();
  });
});
</script>
@endsection