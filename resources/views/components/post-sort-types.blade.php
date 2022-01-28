<div class="mb-2">
  <a type="button" class="btn btn-round {{ $sortType == 'created_at' ? 'btn-dark' : 'btn-outline-dark' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'created_at']) }}"><i class="fas fa-arrow-up"></i> {{ __('جدیدترین‌ها') }}</a>
  <a type="button" class="btn btn-round {{ $sortType == 'comments_count' ? 'btn-dark' : 'btn-outline-dark' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'comments_count']) }}"><i class="fas fa-comments"></i> {{ __('پربحث‌ترین‌ها') }}</a>
  <a type="button" class="btn btn-round {{ $sortType == 'likes_count' ? 'btn-dark' : 'btn-outline-dark' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'likes_count']) }}"><i class="fas fa-thumbs-up"></i> {{ __('محبوب‌ترین‌ها') }}</a>
</div>