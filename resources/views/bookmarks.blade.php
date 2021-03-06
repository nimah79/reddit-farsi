@extends('layouts/header-and-footer')

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">
      <h3 class="mt-3 mb-3"><i class="fas fa-bookmark"></i> {{ __('پست‌های ذخیره‌شده') }}</h3>

      @if ($q)
      <h4 class="mt-4">{{ __('نتایج جست‌وجو برای') }} «{{ $q }}»:</h4>
      @endif

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
        <x-search-card action="" />
        <x-today-hottest-communities-card />
      </div>
    </div>
  </div>
</main>
@endsection

@section('scripts')
@parent
<script>
  $(document).ready(function () {
    $('.btn-like').click(async function () {
      let post_id = $(this).data('postid');
      let response = await fetch('{{ route('post.like', ['post' => '0']) }}'.replace('0', post_id));
      let result = await response.json();
      $('#likes-count-'+post_id).html(result.likes_count);
      $('#dislikes-count-'+post_id).html(result.dislikes_count);
      $('.btn-like[data-postid="'+post_id+'"]').removeClass('btn-dark');
      $('.btn-like[data-postid="'+post_id+'"]').removeClass('btn-outline-dark');
      $('.btn-like[data-postid="'+post_id+'"]').addClass('btn-'+(result.liked ? '' : 'outline-')+'dark');
      $('.btn-dislike[data-postid="'+post_id+'"]').removeClass('btn-dark');
      $('.btn-dislike[data-postid="'+post_id+'"]').removeClass('btn-outline-dark');
      $('.btn-dislike[data-postid="'+post_id+'"]').addClass('btn-'+(result.disliked ? '' : 'outline-')+'dark');
    });

    $('.btn-dislike').click(async function () {
      let post_id = $(this).data('postid');
      let response = await fetch('{{ route('post.dislike', ['post' => '0']) }}'.replace('0', post_id));
      let result = await response.json();
      $('#likes-count-'+post_id).html(result.likes_count);
      $('#dislikes-count-'+post_id).html(result.dislikes_count);
      $('.btn-like[data-postid="'+post_id+'"]').removeClass('btn-dark');
      $('.btn-like[data-postid="'+post_id+'"]').removeClass('btn-outline-dark');
      $('.btn-like[data-postid="'+post_id+'"]').addClass('btn-'+(result.liked ? '' : 'outline-')+'dark');
      $('.btn-dislike[data-postid="'+post_id+'"]').removeClass('btn-dark');
      $('.btn-dislike[data-postid="'+post_id+'"]').removeClass('btn-outline-dark');
      $('.btn-dislike[data-postid="'+post_id+'"]').addClass('btn-'+(result.disliked ? '' : 'outline-')+'dark');
    });
  });
</script>
@endsection