<!-- Modal -->
<div class="modal fade" id="generate-number" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generate Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="generate-number-form" method="post" action="javascript:;" data-action="{{ route('phone.generate') }}">
          <div class="form-group input-group-lg mb-2">
            <label class="text-muted mb-2">Website</label>
            <?php $websites = \App\Models\Website::all(); ?>
            <select class="form-control custom-select custom-select-lg website" name="website">
              <option value="">Select website</option>
              @if(empty($websites))
                <option value="">None listed</option>
              @else
                @foreach($websites as $website)
                  <option value="{{ $website->id }}">
                    {{ ucfirst($website->name) }} - NGN{{ number_format($website->price) }}
                  </option>
                @endforeach
              @endif
            </select>
            <small class="error text-danger website-error"></small>
          </div>
          <div class="form-group input-group-lg mb-2 mb-4">
            <label class="text-muted mb-2">Country</label>
            <?php $countries = \App\Models\Country::all(); ?>
            <select class="form-control custom-select custom-select-lg country" name="country">
              <option value="">Select country</option>
              @if(empty($countries))
                <option value="">None listed</option>
              @else
                @foreach($countries as $country)
                  <option value="{{ $country->id }}">
                    {{ $country->phonecode }} ({{ $country->name }})
                  </option>
                @endforeach
              @endif
            </select>
            <small class="error text-danger country-error"></small>
          </div>
          <div class="generate-number-message alert d-none mb-4"></div>
          <button type="submit" class="main-btn w-100 btn-hover text-white generate-number-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none generate-number-spinner mb-1">
              Generate
          </button>
        </form>
      </div>
    </div>
  </div>
</div>