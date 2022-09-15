
<tr>
    <?php $status = $verification->status; $tenMinutesPassed = \Carbon\Carbon::parse($verification->created_at)->diffInSeconds(\Carbon\Carbon::now()) > (60 * 10); ?>
  @if($status == 'expired' || $status == 'done' || $tenMinutesPassed)
    <td class="">00:00</td>
  @else
	   <td id="timer-active" class="verification-timer-{{ $verification->id }}"></td>
  @endif
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
  	@if($status == 'expired' || $status == 'done' || $tenMinutesPassed)
  	  <small>{{ $verification->code }}</small>
  	@else
      <small class="verification-code-{{ $verification->id }} text-dark"></small>
      <div class="d-none verification-loader-{{ $verification->id }}">
         <img src="/images/spinner.svg" class="mr-2 bg-dark mb-1"> Awaiting code . . .
      </div>
  	@endif
  </td>
  <td>
    <div class="blacklist-prompt" data-url="{{ route('verification.blacklist', ['id' => $verification->id]) }}">
  		<button class="btn text-white btn-primary blacklist-button">
      		<img src="/images/spinner.svg" class="mr-2 d-none blacklist-spinner mb-1">
      			Blacklist
      	</button>
  	</div>
  </td>
</tr>