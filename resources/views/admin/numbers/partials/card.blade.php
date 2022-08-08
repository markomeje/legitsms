<div class="card border-0">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div class="text-dark">
        {{ \Str::limit(ucwords($number->country->name), 12) }}
      </div>
      <div class="text-dark">
        ({{ $number->country->phonecode }})
      </div>
    </div>
    <div class="">
      <button class="main-btn m-0 btn-hover btn-sm w-100 text-white">{{ $number->phone }}</button>
    </div>
  </div>
</div>