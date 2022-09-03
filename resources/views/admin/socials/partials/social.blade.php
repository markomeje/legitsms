<div class="card bg-white shadow-sm border-0">
	<div class="card-body d-flex align-items-center">
		<a href="javascript:;" class="text-dark me-2 text-underline" data-bs-toggle="modal" data-bs-target="#edit-social-{{ $social->id }}">
			<i class="icofont-{{ strtolower($social->company) }}"></i>
		</a>
		<a href="javascript:;" class="text-dark" data-bs-toggle="modal" data-bs-target="#edit-social-{{ $social->id }}">
			{{ ucfirst($social->company) }}
		</a>
	</div>
	<div class="card-footer d-flex bg-dark align-items-center">
		<a href="javascript:;" class="text-danger me-2 delete-social-prompt" data-url={{ route('admin.social.delete', ['id' => $social->id]) }}>
			<small>
				<i class="icofont-trash"></i>
			</small>
		</a>
		<a href="javascript:;" class="text-warning" data-bs-toggle="modal" data-bs-target="#edit-social-{{ $social->id }}">
			<small>
				<i class="icofont-edit"></i>
			</small>
		</a>
	</div>
</div>