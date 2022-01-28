@extends('layouts/app')

@section('stylesheets')
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
@endsection

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
            <img src="{{ auth()->user()->gravatar }}" alt="mdo" width="40" height="40" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm" aria-labelledby="userDropdown">
            <li><p class="dropdown-item text-start">{{ auth()->user()->username }}</p></li>
            <li><p class="dropdown-item text-start">{{ auth()->user()->email }}</p></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item mb-3" href="#"><i class="fas fa-users"></i> {{ __('انجمن‌های من') }}</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> {{ __('تنظیمات حساب کاربری') }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit()"><i class="fas fa-sign-out-alt"></i> {{ __('خروج') }}</a></li>
            <form id="logout-form" style="display:none" action="/logout" method="post">
              @csrf
            </form>
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

@section('scripts')
<script>
  document.querySelector("#darkmode-btn").onclick = function(e) {
    darkmode.toggleDarkMode();
  }
</script>
@endsection