<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#000000">
  <title>@yield('title', __('صفحهٔ اصلی')) | {{ config('app.name') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-nightshade.min.css" rel="stylesheet">
  <link href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
  <header class="header py-3 mb-2">
    <div class="row">
      <div class="col-4 pt-1">
        <a class="text-body" href="{{ url('/') }}"><h4><strong>{{ config('app.name') }}</strong></h4></a>
      </div>
      <div class="col-8 d-flex justify-content-end align-items-center">
        <button id="darkmode-btn" class="btn btn btn-outline-secondary"><i class="far fa-moon"></i></button>
        <span class="mx-1"></span>
        @guest
        <a class="btn btn btn-outline-secondary" href="{{ url('/login') }}">{{ __('ورود/عضویت') }}</a>
        @endguest
        @auth
        <div class="dropdown">
          <a href="#" class="d-block link-secondary dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm" aria-labelledby="userDropdown">
            <li><a class="dropdown-item mb-3" href="#"><i class="fas fa-users"></i> {{ __('انجمن‌های من') }}</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> {{ __('تنظیمات حساب کاربری') }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> {{ __('خروج') }}</a></li>
          </ul>
        </div>
        @endauth
      </div>
    </div>
  </header>
</div>
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
            <div class="col-3 col-lg-2">
              <img src="https://laravel.qcollege.ir/web/storage/images/posts/2021/1627847477_lorem-ipsum.jpg" alt="lorem-ipsum-2" class="img-fluid index-post-image rounded">
            </div>
            <div class="col-9 col-lg-10 pt-2">
              <a href="/posts/lorem-ipsum-2" class="text-body"><h5 class="card-title">{{ $post->title }}</h5></a>
              <h6 class="card-subtitle mb-2 text-muted small ltr">{{ $post->created_at }}</h6>
              <h6 class="card-subtitle mb-2 text-muted small">{{ __('در') }} <a class="text-body hover-underline" href="#">{{ $post->community->name }}</a>{{ __('،') }} {{ __('توسط') }} <a class="text-body hover-underline" href="#"> {{ $post->user->username }}</a></h6>
            </div>
          </div>
          {{ $post->body }}
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

<footer class="text-body">
  <p>{{ __('ساخته شده با افتخار در ایران | ۱۴۰۰') }}</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/js/darkmode.min.js"></script>
<script>
  document.querySelector("#darkmode-btn").onclick = function(e) {
    darkmode.toggleDarkMode();
  }
</script>
</body>
</html>