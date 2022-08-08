<div class="card">
	<div class="card-body p-4">
		<div class="d-flex align-items-center justify-content-between">
			<div class="cursor-pointer text-underline" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				{{ ucfirst(\Str::limit($website->name, 8)) }}
			</div>
			<div class="text-dark">
				NGN{{ number_format($website->price) }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-dark p-4 d-flex justify-content-between">
		<div class="form-check form-switch cursor-pointer">
		  	<input class="form-check-input border-0 active-website {{ true === (boolean)$website->active ? 'bg-success' : ''}}" type="checkbox" id="active-website" {{ true === (boolean)$website->active ? 'checked' : ''}}>
		  	<label class="form-check-label" for="active-website"></label>
		</div>
		<div class="d-flex align-items-center">
			<small class="text-danger cursor-pointer me-2">
				<i class="icofont-trash"></i>
			</small>
			<small class="text-warning cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-website-{{ $website->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>