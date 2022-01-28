@extends('layouts/app')

@section('content')
<body> 
<main class="form-auth">
    <div class="mb-4 text-center">
      <h1><strong><a href="{{ url('/') }}" class="link-dark">{{ config('app.name') }}</a></strong></h1>
    <h3 class="mb-3 fw-normal">{{ __('ثبت‌نام') }}</h3>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      {!! implode('', $errors->all(':message<br>')) !!}
    </div>
    @endif
    <form method="post">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label">نام کاربری</label>
        <input dir="ltr" type="text" class="form-control" id="username" name="username" placeholder="نام کاربری">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">آدرس ایمیل</label>
        <input dir="ltr" type="email" class="form-control" id="email" name="email" placeholder="آدرس ایمیل">
      </div>
      <label for="password" class="form-label">رمز عبور</label>
      <div class="input-group mb-3" id="show_hide_password">
        <button class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
        <input dir="ltr" type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
      </div>
      <button class="w-100 btn btn-lg btn-dark btn-primary" type="submit">ثبت‌نام</button>
    </form>
    <p class="text-center mt-5 mb-3">حساب کاربری دارید؟ <a href="{{ url('/login') }}">{{ __('وارد شوید') }}</a></p>
</main>
</body>
@endsection

@section('stylesheets')
<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script>
  $("#show_hide_password button").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye" );
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
    } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye" );
        $('#show_hide_password i').addClass( "fa-eye-slash" );
    }
  });
</script>
@endsection