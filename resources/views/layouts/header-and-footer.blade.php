@extends('layouts/app')

@section('content')
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
@section('main')
@show
<footer class="text-body">
  <p>{{ __('ساخته شده با افتخار در ایران | ۱۴۰۰') }}</p>
</footer>
@endsection