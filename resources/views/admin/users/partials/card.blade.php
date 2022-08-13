<div class="card border-0 shadow-sm position-relative">
    <?php $status = strtolower($user->status ?? ''); ?>
    <div class="card-body d-flex align-items-center">
        <a href="mailto:{{ $user->email }}" class="rounded-circle me-2" style="height: 45px; width: 45px; line-height: 30px;">
            <div class="p-1 m-0 border border-{{ $status == 'active' ? 'success' : 'danger' }} rounded-circle w-100 h-100">
                <div class="w-100 h-100 border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                    <small class="text-main-dark">
                        {{ substr(strtoupper($user->username), 0, 1) }}
                    </small>
                </div>
            </div>
        </a>
        <div class="">
            <div class="text-dark">
                {{ ucfirst(\Str::limit($user->username, 12)) }}
            </div>
            <small class="text-dark">
                {{ $user->created_at->diffForHumans() }}
            </small> 
        </div>
    </div>
</div>