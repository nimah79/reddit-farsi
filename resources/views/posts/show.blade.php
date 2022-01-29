@extends('layouts/header-and-footer')

@section('title', $post->title)

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">

      <x-post-card :post="$post"/>

      <h3><i class="fas fa-comments"></i> {{ __('کامنت‌ها') }}</h3>

  <div class="row">
    <div class="col-12">
      <section class="comments">
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-plus"></i> {{ __('افزودن کامنت جدید') }}</h5>
            <form method="post">
              <div class="mb-3">
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-dark">{{ __('ارسال') }}</button>
            </form>
          </div>
        </div>
        @foreach ($post->comments()->whereNull('parent_id')->orderBy('likes_count', 'desc')->orderBy('created_at', 'desc')->get() as $comment)
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-1 col-lg-1">
                <img src="{{ $comment->user->gravatar }}" alt="mdo" width="50" height="50" class="rounded-circle">
              </div>
              <div class="col-9 col-lg-10 pt-2">
                <h6 class="card-subtitle mb-2 small"><a href="#" class="text-body">{{ $comment->user->username }}</a></h6>
                <h6 class="card-subtitle mb-2 text-muted small">{{ to_persian_digits(verta($comment->created_at)) }}</h6>
              </div>
            </div>
            <p class="mt-4">{{ $comment->body }}</p>
            <div class="float-start pt-1">
              @auth
              <button type="button" class="btn btn-{{ $comment->dislikes()->whereUserId(auth()->user()->id)->exists() ? '' : 'outline-' }}dark btn-dislike-comment" data-commentid="{{ $comment->parent_id ?? $comment->id }}"><i class="fas fa-thumbs-down"></i> <span id="dislikes-count-{{ $comment->id }}">{{ to_persian_digits($comment->dislikes_count) }}</span></button>
              <button type="button" class="btn btn-{{ $comment->likes()->whereUserId(auth()->user()->id)->exists() ? '' : 'outline-' }}dark btn-like-comment" data-commentid="{{ $comment->parent_id ?? $comment->id }}"><i class="fas fa-thumbs-up"></i> <span id="likes-count-{{ $comment->id }}">{{ to_persian_digits($comment->likes_count) }}</span></button>
              <button type="button" class="btn btn-dark btn-reply" data-commentid="{{ $comment->parent_id ?? $comment->id }}"><i class="fas fa-reply"></i> {{ __('پاسخ دادن') }}</button>
              @endauth
              @guest
              <i class="fas fa-thumbs-down"></i> {{ to_persian_digits($comment->dislikes_count) }}
              <span class="mx-1"></span>
              <i class="fas fa-thumbs-up"></i> {{ to_persian_digits($comment->likes_count) }}
              @endguest
            </div>
          </div>
          @php ($replies = App\Models\Comment::whereParentId($comment->id)->orderBy('likes_count', 'desc')->orderBy('created_at', 'desc')->get())
          <div class="card-footer bg-body" data-commentid="{{ $comment->id }}"{!! empty($replies) ? ' style="display: none;"' : '' !!}>
            <div class="replies">
              @foreach ($replies as $reply)
                 <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-1 col-lg-1">
                <img src="{{ $reply->user->gravatar }}" alt="mdo" width="50" height="50" class="rounded-circle">
              </div>
              <div class="col-9 col-lg-10 pt-2">
                <h6 class="card-subtitle mb-2 small"><a href="#" class="text-body">{{ $reply->user->username }}</a></h6>
                <h6 class="card-subtitle mb-2 text-muted small">{{ to_persian_digits(verta($reply->created_at)) }}</h6>
              </div>
            </div>
            <p class="mt-4">{{ $reply->body }}</p>
            <div class="float-start pt-1">
              @auth
              <button type="button" class="btn btn-{{ $reply->dislikes()->whereUserId(auth()->user()->id)->exists() ? '' : 'outline-' }}dark btn-dislike-comment" data-commentid="{{ $reply->id }}" data-parentid="{{ $reply->parent_id }}"><i class="fas fa-thumbs-down"></i> <span id="dislikes-count-{{ $reply->id }}">{{ to_persian_digits($reply->dislikes_count) }}</span></button>
              <button type="button" class="btn btn-{{ $reply->likes()->whereUserId(auth()->user()->id)->exists() ? '' : 'outline-' }}dark btn-like-comment" data-commentid="{{ $reply->id }}" data-parentid="{{ $reply->parent_id }}"><i class="fas fa-thumbs-up"></i> <span id="likes-count-{{ $reply->id }}">{{ to_persian_digits($reply->likes_count) }}</span></button>
              <button type="button" class="btn btn-dark btn-reply" data-commentid="{{ $reply->id }}" data-parentid="{{ $reply->parent_id }}"><i class="fas fa-reply"></i> {{ __('پاسخ دادن') }}</button>
              @endauth
              @guest
              <i class="fas fa-thumbs-down"></i> {{ to_persian_digits($reply->dislikes_count) }}
              <span class="mx-1"></span>
              <i class="fas fa-thumbs-up"></i> {{ to_persian_digits($reply->likes_count) }}
              @endguest
            </div>
          </div>
        </div>
              @endforeach
            </div>
            <div class="reply-box" style="display: none;"></div>
          </div>
        </div>
        @endforeach
      </section>
    </div>
  </div>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 1rem;">
        <x-search-card :action="url('/')" />
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
    $('.btn-reply').click(async function () {
      let comment_id = $(this).data('commentid');
      if ($(this).data('parentid')) {
        comment_id = $(this).data('parentid');
      }
      $('.card-footer[data-commentid="'+comment_id+'"] .reply-box').html(`
         <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-reply"></i> {{ __('افزودن پاسخ') }}</h5>
            <form method="post">
            @csrf
              <input type="hidden" name="parent_id" value="`+comment_id+`">
              <div class="mb-3">
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-dark">{{ __('ارسال') }}</button>
            </form>
          </div>
        </div>
        `);
      $('.card-footer[data-commentid="'+comment_id+'"]').show();
      $('.card-footer[data-commentid="'+comment_id+'"] .reply-box').toggle();
    });

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

    $('.btn-like-comment').click(async function () {
      let comment_id = $(this).data('commentid');
      let response = await fetch('{{ route('comment.like', ['comment' => '0']) }}'.replace('0', comment_id));
      let result = await response.json();
      $('#likes-count-'+comment_id).html(result.likes_count);
      $('#dislikes-count-'+comment_id).html(result.dislikes_count);
      $('.btn-like-comment[data-commentid="'+comment_id+'"]').removeClass('btn-dark');
      $('.btn-like-comment[data-commentid="'+comment_id+'"]').removeClass('btn-outline-dark');
      $('.btn-like-comment[data-commentid="'+comment_id+'"]').addClass('btn-'+(result.liked ? '' : 'outline-')+'dark');
      $('.btn-dislike-comment[data-commentid="'+comment_id+'"]').removeClass('btn-dark');
      $('.btn-dislike-comment[data-commentid="'+comment_id+'"]').removeClass('btn-outline-dark');
      $('.btn-dislike-comment[data-commentid="'+comment_id+'"]').addClass('btn-'+(result.disliked ? '' : 'outline-')+'dark');
    });

    $('.btn-dislike-comment').click(async function () {
      let comment_id = $(this).data('commentid');
      let response = await fetch('{{ route('comment.dislike', ['comment' => '0']) }}'.replace('0', comment_id));
      let result = await response.json();
      $('#likes-count-'+comment_id).html(result.likes_count);
      $('#dislikes-count-'+comment_id).html(result.dislikes_count);
      $('.btn-like-comment[data-commentid="'+comment_id+'"]').removeClass('btn-dark');
      $('.btn-like-comment[data-commentid="'+comment_id+'"]').removeClass('btn-outline-dark');
      $('.btn-like-comment[data-commentid="'+comment_id+'"]').addClass('btn-'+(result.liked ? '' : 'outline-')+'dark');
      $('.btn-dislike-comment[data-commentid="'+comment_id+'"]').removeClass('btn-dark');
      $('.btn-dislike-comment[data-commentid="'+comment_id+'"]').removeClass('btn-outline-dark');
      $('.btn-dislike-comment[data-commentid="'+comment_id+'"]').addClass('btn-'+(result.disliked ? '' : 'outline-')+'dark');
    });
  });
</script>
@endsection