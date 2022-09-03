<div class="card border-0 shadow-sm position-relative">
    <?php $status = strtolower($user->status ?? ''); ?>
    <div class="card-body d-flex align-items-center justify-content-between p-4">
        <div class="d-flex align-items-center">
            {{-- <a href="mailto:{{ $user->email }}" class="rounded-circle me-2" style="height: 45px; width: 45px; line-height: 30px;">
                <div class="p-1 m-0 border border-{{ $status == 'active' ? 'success' : 'danger' }} rounded-circle w-100 h-100">
                    <div class="w-100 h-100 border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                        <small class="text-main-dark">
                            {{ substr(strtoupper($user->username), 0, 1) }}
                        </small>
                    </div>
                </div>
            </a> --}}
            <div class="">
                <a href="mailto:{{ $user->email }}" class="text-dark">
                    {{ ucfirst($user->email) }}
                </a>
                <div class="text-{{ strtolower($user->status) == 'active' ? 'success' : 'danger'; }}">
                    {{ ucfirst($user->status ?? 'Nill') }}
                </div>
            </div>
        </div>
        <div class="dropdown">
          <div class="dropdown-toggle cursor-pointer" id="user-drop-{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false"></div>
          <div class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="user-drop-{{ $user->id }}">
            <a class="dropdown-item" href="javascript:;">
                {{ ucwords($user->username) }}
            </a>
          </div>
        </div> 
    </div>
    <div class="card-footer bg-dark p-4">
        <small class="text-white">
            {{ $user->created_at->diffForHumans() }}
        </small> 
    </div>
</div>