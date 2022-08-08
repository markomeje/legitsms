<div class="card border-0 shadow-sm">
  <div class="card-body p-4">
    <div class="d-flex align-items-center justify-content-between">
      <div class="text-dark">
        Code: {{ $text->message }}
      </div>
      <div class="text-dark text-underline">
        {{ \Str::limit(ucwords($text->website->name), 5) }}
      </div>
    </div>
  </div>
  <div class="card-footer bg-light py-3">
    <small>
      {{ $text->created_at->diffForHumans() }}
    </small>
  </div>
</div>