<div class="table-responsive table-responsive-sm">
		<table class="table table-striped table-hover">
	  <thead>
	    <tr>
	      <th scope="col">Country</th>
	      <th scope="col">Website</th>
	      <th scope="col">Phone</th>
	      <th scope="col">Code</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  		@foreach($verifications as $verification)
			  <tbody>
			    <tr>
			      <td>
			      	{{ $verification->country->name }}
			      </td>
			      <td>
			      	{{ $verification->website->name }}
			      </td>
			      <td>
			      	<a href="tel:{{ ucfirst($verification->phone) }}">{{ ucfirst($verification->phone) }}</a>
			      </td>
			      <td>
			      	<small>
			      		{{ $verification->code ?? 'Waiting . . .' }}
			      	</small>
			      </td>
			      <td>
			      	<?php $id = $verification->id; ?>
			      	@if(empty($verification->code))
				      	<div class="read-sms-prompt-{{ $id }}" data-url="{{ route('client.verification.read.sms', ['id' => $id]) }}">
				      		<button class="btn text-white btn-primary read-sms-button-{{ $id }}">
					      		<img src="/images/spinner.svg" class="mr-2 d-none read-sms-spinner-{{ $id }} mb-1">
					      		Read Sms
					      	</button>
				      	</div>
			      	@else
			      		<div class="">
				      		<button class="btn text-dark btn-secondary" disabled>Code Done</button>
				      	</div>
			      	@endif
			      </td>
			    </tr>
			</tbody>
			@endforeach
	</table>
</div>