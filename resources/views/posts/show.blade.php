@extends('layouts/header-and-footer')

@section('title', $post->title)

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">

      <x-post-card :post="$post"/>

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
              <h6 class="card-subtitle mb-2 small"><a href="#" class="text-body">نیما حیدری‌نسب</a></h6>
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
        <x-today-hottest-communities-card />
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