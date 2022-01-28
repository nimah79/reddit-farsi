@extends('layouts/header-and-footer')

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="mb-2">
        <button type="button" class="btn btn-round btn-dark"><i class="fas fa-arrow-up"></i> {{ __('جدیدترین‌ها') }}</button>
        <button type="button" class="btn btn-round btn-outline-dark"><i class="fas fa-comments"></i> {{ __('پربحث‌ترین‌ها') }}</button>
        <button type="button" class="btn btn-round btn-outline-dark"><i class="fas fa-thumbs-up"></i> {{ __('محبوب‌ترین‌ها') }}</button>
      </div>

      @foreach ($posts as $post)
      <article class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9 col-lg-10 pt-2">
              <a href="/posts/lorem-ipsum-2" class="text-body"><h5 class="card-title">{{ $post->title }}</h5></a>
              <h6 class="card-subtitle mb-2 text-muted small">{{ to_persian_digits(verta($post->created_at)) }}</h6>
              <h6 class="card-subtitle mb-2 text-muted small">{{ __('در') }} <a class="text-body hover-underline" href="#">{{ $post->community->name }}</a>{{ __('،') }} {{ __('توسط') }} <a class="text-body hover-underline" href="#"> {{ $post->user->username }}</a></h6>
            </div>
          </div>
          {!! $post->rendered_body !!}
        </div>
        <div class="card-footer bg-body">
          <div class="float-start pt-1">
            <i class="fas fa-comments"></i> ۴۳
            <span class="mx-1"></span>
            <button type="button" class="btn btn-outline-dark"><i class="fas fa-thumbs-down"></i> ۹</button>
            <button type="button" class="btn btn-dark"><i class="fas fa-thumbs-up"></i> ۱۲۳</button></div>
          <div class="float-end"><a href="/posts/lorem-ipsum-2" class="btn btn-dark">{{ __('ادامه') }}</a></div>
        </div>
      </article>
      @endforeach

      <nav class="pagination" aria-label="Pagination">
        @if (!$posts->onFirstPage())
        <a class="btn btn-round btn-outline-dark" href="{{ $posts->previousPageUrl() }}"><i class="fas fa-chevron-right"></i> {{ __('مطالب جدیدتر') }}</a>
        @endif
        @if ($posts->hasMorePages())
        <a class="btn btn-round btn-outline-dark" href="{{ $posts->nextPageUrl() }}">{{ __('مطالب قدیمی‌تر') }} <i class="fas fa-chevron-left"></i></a>
        @endif
      </nav>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="card shadow-sm p-4 mb-3 bg-body rounded">
          <h4><i class="fas fa-fire"></i> {{ __('داغ‌ترین انجمن‌های امروز') }}</h4>
          <p class="mb-0">انجمن شاعران مرده</p>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection