<div class="card">
	<div class="card-body d-flex align-items-center">
		<div class="me-2">
			<img src="https://flagcdn.com/w20/{{ strtolower($country->iso2) }}.png" srcset="https://flagcdn.com/w40/{{ strtolower($country->iso2) }}.png 2x" width="20" alt="{{ ucwords($country->name) }}" class="border h-100 object-cover">
		</div>
		<div>
			{{ \Str::limit(ucwords($country->name), 12) }}
		</div>
	</div>
</div>