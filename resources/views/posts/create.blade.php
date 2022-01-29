@extends('layouts/header-and-footer')

@section('title', 'انجمن‌های من')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('assets/css/markdown-editor.min.css') }}">
@endsection

@section('main')
<main class="container">
  <div class="row">
    <div class="col-md-8">
      <article class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9 col-lg-10 pt-2">
              <h5 class="card-title"><i class="fas fa-pencil"></i> {{ __('نوشتن پست جدید') }}</h5>
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
              <label for="community_id" class="form-label">انجمن</label>
              <select id="community_id" name="community_id" class="form-select" required>
                <option value="">یک انجمن را انتخاب کنید.</option>
                @foreach (auth()->user()->communities as $community)
                <option value="{{ $community->id }}">{{ $community->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">عنوان پست</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">متن پست</label>
              <textarea id="body" name="body" class="form-control" rows="10" required>متن خود را این‌جا بنویسید...</textarea>
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
<script src="{{ asset('assets/js/markdown-editor.min.js') }}"></script>
<script src="{{ asset('assets/js/markdown-it.min.js') }}"></script>
<script>
  $('#body').markdownEditor({
    hiddenActions: ['emoji', 'export']
  });
</script>
@endsection