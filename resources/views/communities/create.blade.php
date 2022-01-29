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
              <h5 class="card-title"><i class="fas fa-plus"></i> {{ __('ساخت انجمن جدید') }}</h5>
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
              <label for="name" class="form-label">نام انجمن</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">توضیحات</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark">{{ __('ایجاد') }}</button>
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