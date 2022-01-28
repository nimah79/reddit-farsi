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
              <h5 class="card-title"><i class="fas fa-users"></i> انجمن‌های من</h5>
            </div>
          </div>
          <a href="{{ route('community.create') }}" class="btn btn-secondary"><i class="fas fa-plus"></i> ساخت انجمن جدید</a>
          <table class="table table-striped">
              <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">نام انجمن</th>
              <th scope="col">نام کاربری سازنده</th>
              <th scope="col">عملیات‌ها</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($communities as $community)
            <tr>
              <th scope="row">{{ to_persian_digits($loop->index + 1) }}</th>
              <td>{{ $community->name }}</td>
              <td>{{ $community->creator->username }}</td>
              <td>
                <a href="{{ url('/') }}" class="btn btn-success"><i class="fas fa-users"></i></a>
                <a href="{{ route('community.edit', ['community' => $community->id]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fas fa-ban"></i></a>
                <a href="{{ url('/') }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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