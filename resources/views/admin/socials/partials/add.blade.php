<!-- Modal -->
<div class="modal fade" id="add-social" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Social</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-social-form" method="post" action="javascript:;" data-action="{{ route('admin.social.add') }}">
          <div class="row">
            <div class="form-group input-group-lg col-md-6 mb-4">
              <label class="text-muted mb-2">Social platform</label>
              <select class="form-control custom-select platform" name="platform">
                <?php $platforms = \App\Models\Social::$platforms; ?>
                @if(empty($platforms))
                  <option value="">No platforms names listed</option>
                @else
                  @foreach($platforms as $platform)
                    <option value="{{ strtolower($platform) }}">
                      {{ ucfirst($platform) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="error text-danger platform-error"></small>
            </div>
            <div class="form-group input-group-lg col-md-6 mb-4">
              <label class="text-muted mb-2">Link</label>
              <input type="text" name="link" class="form-control link" placeholder="Enter link">
              <small class="error text-danger link-error"></small>
            </div>
          </div>
          <div class="add-social-message alert d-none mb-4"></div>
          <button type="submit" class="btn btn-primary btn-lg btn-hover text-white add-social-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none add-social-spinner mb-1">
              Add
          </button>
        </form>
      </div>
    </div>
  </div>
</div>