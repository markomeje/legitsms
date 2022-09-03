<div class="card border-0 shadow-sm">
	<div class="card-body">
		<div class="d-flex align-items-center justify-content-between">
			<div class="dropdown">
			  <div class="dropdown-toggle cursor-pointer" id="country-drop-{{ $country->id }}" data-bs-toggle="dropdown" aria-expanded="false">
			    {{ \Str::limit(ucwords($country->name), 8) }}
			  </div>
			  <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="country-drop-{{ $country->id }}">
			    <a class="dropdown-item" href="javascript:;">
			    	{{ ucwords($country->name) }}
			    </a>
			  </div>
			</div>
			<a href="javascript:;" class="text-dark text-underline" data-bs-toggle="modal" data-bs-target="#edit-country-{{ $country->id }}">
				ID ({{ $country->id_number ?? 'Nil' }})
			</a>
		</div>
	</div>
	<div class="card-footer bg-dark p-4 d-flex justify-content-between">
		<small class="text-white">
			{{ $country->websites->count() }} Website(s)
		</small>
		<div class="d-flex align-items-center">
			<small class="text-danger cursor-pointer me-2 delete-country-prompt" data-url="{{ route('admin.country.delete', ['id' => $country->id]) }}">
				<i class="icofont-trash"></i>
			</small>
			<small class="text-warning cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-country-{{ $country->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>