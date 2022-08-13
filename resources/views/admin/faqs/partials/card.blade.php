<div class="card border-0 shadow-sm">
	<div class="card-body p-4">
		<div class="d-flex align-items-center justify-content-between">
			<div class="cursor-pointer text-underline" data-bs-toggle="modal" data-bs-target="#edit-faq-{{ $faq->id }}">
				{{ ucfirst(\Str::limit($faq->question, 22)) }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-dark p-4 d-flex justify-content-between">
		<small class="text-white">
			{{ $faq->created_at->diffForHumans() }}
		</small>
		<div class="d-flex align-items-center">
			<small class="text-danger cursor-pointer me-2 delete-faq-prompt" data-url="{{ route('admin.faq.delete', ['id' => $faq->id]) }}">
				<i class="icofont-trash"></i>
			</small>
			<small class="text-warning cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit-faq-{{ $faq->id }}">
				<i class="icofont-edit"></i>
			</small>
		</div>
	</div>
</div>