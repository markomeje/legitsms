<div class="card border-0 shadow-sm position-relative rounded-0">
    <?php $status = strtolower($user->status ?? ''); ?>
    <div class="card-header py-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="tel:{{ $user->email }}" class="mr-2 text-decoration-none sm-circle text-center rounded-circle border border-primary">
                <small class="text-primary tiny-font mt-2">
                    <i class="icofont-email"></i>
                </small>
            </a>
        </div>
        <div class="text-dark">
            {{ ucfirst($user->status) }}
        </div>
    </div>
    <div class="card-body">
        <div class="text-dark">
            {{ ucfirst($user->username ?? 'Nill') }}
        </div>
    </div>
    <div class="card-footer bg-white py-4 d-flex justify-content-between rounded-0">
        <small class="text-dark">
            {{ $user->created_at->diffForHumans() }}
        </small> 
    </div>
</div>