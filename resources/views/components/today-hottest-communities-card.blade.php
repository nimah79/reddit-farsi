<div class="card shadow-sm p-4 mb-3 bg-body rounded">
  <h4><i class="fas fa-fire"></i> {{ __('داغ‌ترین انجمن‌های امروز') }}</h4>
  <ul class="mt-3">
    @foreach (App\Models\Post::select('communities.name', DB::raw('COUNT(*) as posts_count'))->join('communities', 'posts.community_id', '=', 'communities.id')->whereDate('posts.created_at', Carbon\Carbon::today())->groupBy('communities.id')->take(5)->orderBy('posts_count', 'desc')->get() as $community)
    <li>{{ $community->name }} ({{ to_persian_digits($community->posts_count) }} {{ __('پست') }})</li>
    @endforeach
  </ul>
</div>