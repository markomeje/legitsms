<!-- Modal -->
<div class="modal fade" id="read-sms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Read Sms</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="read-sms-form" method="post" action="javascript:;" data-action="{{ route('user.sms.read') }}">
          <div class="form-group input-group-lg mb-2 mb-4">
            <label class="text-muted mb-2">Phone Number</label>
            <?php $numbers = \App\Models\Number::all(); ?>
            <select class="form-control custom-select custom-select-lg phone" name="phone">
              <option value="">Select phone</option>
              @if(empty($numbers))
                <option value="">None listed</option>
              @else
                @foreach($numbers as $number)
                  <option value="{{ $number->id }}">
                    {{ $number->phone }} ({{ $number->country->phonecode }})
                  </option>
                @endforeach
              @endif
            </select>
            <small class="error text-danger phone-error"></small>
          </div>
          <div class="read-sms-message alert d-none mb-4"></div>
          <button type="submit" class="main-btn w-100 btn-hover text-white read-sms-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none read-sms-spinner mb-1">
              Read
          </button>
        </form>
      </div>
    </div>
  </div>
</div>