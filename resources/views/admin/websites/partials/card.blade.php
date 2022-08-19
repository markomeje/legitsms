<div class="card border-0 shadow-sm">
	<div class="card-body p-4">
		<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
			<div class="cursor-pointer text-underline" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				{{ ucfirst(\Str::limit($website->name, 8)) }}
			</div>
			<div class="text-dark cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				NGN{{ number_format($website->price) }}
			</div>
		</div>
		<div class="d-flex align-items-center justify-content-between">
			<div class="cursor-pointer text-underline" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				{{ ucfirst(\Str::limit($website->country->name, 8)) }}
			</div>
			<div class="text-dark cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				ID({{ $website->code }})
			</div>
		</div>
	</div>
	<div class="card-footer bg-dark p-4 d-flex justify-content-between">
		<div class="d-flex align-items-center">
			<small class="text-danger cursor-pointer me-2 delete-website-prompt" data-url="{{ route('admin.website.delete', ['id' => $website->id]) }}">
				<i class="icofont-trash"></i>
			</small>
			<small class="text-warning cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>