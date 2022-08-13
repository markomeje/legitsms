<div class="card border-0 shadow-sm">
	<div class="card-body d-flex align-items-center">
		<div class="me-2">
			<img src="https://flagcdn.com/w20/{{ strtolower($country->iso2) }}.png" srcset="https://flagcdn.com/w40/{{ strtolower($country->iso2) }}.png 2x" width="20" alt="{{ ucwords($country->name) }}" class="border h-100 object-cover">
		</div>
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
	</div>
	<div class="card-footer bg-dark p-4 d-flex justify-content-between">
		<small class="text-white">
			{{ $country->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<small class="text-danger cursor-pointer me-2 delete-country-prompt" data-url="{{ route('admin.country.delete', ['id' => $country->id]) }}">
				<i class="icofont-trash"></i>
			</small>
		</div>
	</div>
</div>