<div class="accordion-item mb-3">
    <h2 class="accordion-header" id="heading-{{ $website->id }}">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $website->id }}" aria-expanded="true" aria-controls="collapse-{{ $website->id }}">
        <div class="d-flex align-items-center justify-content-between w-100">
        	<div class="d-flex align-items-center">
        		<div class="me-2">
					<i class="cflag cflag-{{ \Str::slug($website->country->name) }}" alt="{{ $website->country->name }}"></i>
				</div>
				<div class="text-dark">
					{{ ucfirst($website->name) }}
				</div>
        	</div>
			<div>
				NGN{{ number_format($website->price) }}
			</div>	
		</div>
      </button>
    </h2>
    <div id="collapse-{{ $website->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $website->id }}" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      	@if(auth()->check())
	      	<div class="verify-sms-prompt" data-url="{{ route('verification.process', ['website_id' => $website->id, 'country_id' => $website->country->id]) }}">
	      		<button class="btn btn-block w-100 text-white btn-primary verify-sms-button">
		      		<img src="/images/spinner.svg" class="mr-2 d-none verify-sms-spinner mb-1">
		      		Verify {{ ucwords($website->country->name) }} Number
		      	</button>
	      	</div>
      	@else
      		<a href="{{ route('login') }}" class="btn btn-dark w-100">Please Login to continue</a>
      	@endif
      </div>
    </div>
  </div>