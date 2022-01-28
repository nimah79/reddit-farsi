@extends('layouts/header-and-footer')

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">
      <x-post-sort-types :sortType="$sortType" />

      @each('components.post-card-with-comments-button', $posts, 'post')

      <nav class="pagination" aria-label="Pagination">
        @if (!$posts->onFirstPage())
        <a class="btn btn-round btn-outline-dark" href="{{ $posts->previousPageUrl() }}"><i class="fas fa-chevron-right"></i> {{ __('مطالب جدیدتر') }}</a>
        @endif
        @if ($posts->hasMorePages())
          @if (!$posts->onFirstPage())
          <span class="mx-1"></span>
          @endif
        <a class="btn btn-round btn-outline-dark" href="{{ $posts->nextPageUrl() }}">{{ __('مطالب قدیمی‌تر') }} <i class="fas fa-chevron-left"></i></a>
        @endif
      </nav>

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