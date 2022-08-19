
<tr>
	{{-- <td id="timer"></td> --}}
  <td>
  	<i class="cflag cflag-{{ \Str::slug($verification->country->name) }}" alt="{{ $verification->country->name }}"></i>
  	
  </td>
  <td>
  	{{ $verification->website->name }}
  </td>
  <td>
  	<a href="tel:{{ $verification->phone }}">+{{ ucfirst($verification->phone) }}</a>
  </td>
  <td>
  	@if(empty($verification->code))
	  	<small class="verification-code-{{ $verification->id }} text-dark">
	  		<img src="/images/spinner.svg" class="mr-2 bg-dark d-none verification-loader-{{ $verification->id }} mb-1"></small>
  	@else
  		<small>{{ $verification->code }}</small>
  	@endif
  </td>
  <td>
    <div class="blacklist-prompt-{{ $verification->id }}" data-url="{{ route('verification.blacklist', ['id' => $verification->id]) }}">
  		<button class="btn text-white btn-primary blacklist-button-{{ $verification->id }}">
      		<img src="/images/spinner.svg" class="mr-2 d-none blacklist-spinner-{{ $verification->id }} mb-1">
      			Blacklist
      	</button>
  	</div>
  </td>
</tr>