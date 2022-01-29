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
              <h5 class="card-title"><i class="fas fa-users"></i> {{ __('مدیران انجمن') }} «{{ $community->name }}»</h5>
            </div>
          </div>

          <form method="post">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">{{ __('نام کاربری') }}</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <button type="submit" class="btn btn-dark">{{ __('افزودن مدیر') }}</button>
          </form>
          
          <table class="table table-striped">
              <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">نام کاربری</th>
              <th scope="col">عملیات‌ها</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($community->admins as $admin)
            <tr>
              <th scope="row">{{ to_persian_digits($loop->index + 1) }}</th>
              <td>{{ $admin->username }}</td>
              <td>
                @if (!in_array($admin->id, [auth()->user()->id, $community->creator_id]))
                  <a href="{{ route('community.delete-admin', ['community' => $community->id, 'user' => $admin->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </article>
    </div>
    <div class="col-md-4">
      <div class="position-sticky" style="top: 1rem;">
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