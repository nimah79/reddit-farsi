<div class="card shadow-sm p-4 mb-3 bg-body rounded">
  <form action="{{ $action }}">
    <div class="input-group mb-3">
      <input type="text" name="q" class="form-control" placeholder="جست‌وجو..." aria-describedby="search-addon">
      <button type="submit" class="btn btn-outline-dark" type="button" id="search-addon"><i class="fas fa-search"></i> {{ __('جست‌وجو') }}</button>
    </div>
  </form>
</div>