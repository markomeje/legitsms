<div class="card border-0 shadow">
  <div class="card-body d-flex align-items-center justify-content-between">
    <div class="m-0">
      NGN{{ number_format($deposit->amount) }}
    </div>
    <div class="m-0 text-success">
      {{ ucfirst($deposit->status) }}
    </div>
  </div>
  <div class="card-footer bg-dark py-4 d-flex justify-content-between">
    <small class="text-white">
      {{ $deposit->created_at->diffForHumans() }}
    </small>
  </div>
</div>