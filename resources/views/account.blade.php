@extends('layouts/header-and-footer')

@section('title', 'انجمن‌های من')

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">
      <article class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9 col-lg-10 pt-2">
              <h5 class="card-title"><i class="fas fa-user-cog"></i> {{ __('تنظیمات حساب کاربری') }}</h5>
            </div>
          </div>
          @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            {!! implode('', $errors->all(':message<br>')) !!}
          </div>
          @endif
          <form method="post">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">{{ __('نام کاربری') }}</label>
              <input dir="ltr" type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username }}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">{{ __('آدرس ایمیل') }}</label>
              <input dir="ltr" type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">{{ __('رمز عبور جدید') }}</label>
              <input dir="ltr" type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">{{ __('تکرار رمز عبور جدید') }}</label>
              <input dir="ltr" type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-dark">{{ __('ویرایش') }}</button>
          </form>
        </div>
      </article>
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
$(document).ready(function(){
  $(".reply-popup").click(function(){
    $(".reply-box").toggle();
  });
});
</script>
@endsection