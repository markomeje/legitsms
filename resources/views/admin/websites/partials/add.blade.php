<!-- Modal -->
<div class="modal fade" id="add-website" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Website</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-website-form" method="post" action="javascript:;" data-action="{{ route('admin.website.add') }}">
          <div class="row">
            <div class="form-group input-group-lg col-md-6 mb-4">
              <label class="text-muted mb-2">Website Name</label>
              <input type="text" name="name" class="form-control name" placeholder="Enter website name">
              <small class="error text-danger name-error"></small>
            </div>
            <div class="form-group input-group-lg col-md-6 mb-4">
              <label class="text-muted mb-2">Code(ID)</label>
              <input type="text" name="code" class="form-control code" placeholder="Enter website code">
              <small class="error text-danger code-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group input-group-lg col-md-6 mb-4">
              <label class="text-muted mb-2">Price (NGN100 minimum)</label>
              <input type="number" min="100" name="price" class="form-control price" placeholder="Enter price">
              <small class="error text-danger price-error"></small>
            </div>
            <div class="form-group input-group-lg col-md-6 mb-4">
              <label class="text-muted mb-2">Status</label>
              <select class="form-control custom-select status" name="status">
                <?php $status = \App\Models\Website::STATUS; ?>
                @if(empty($status))
                  <option value="">No status listed</option>
                @else
                  @foreach($status as $key => $value)
                    <option value="{{ $value }}">
                      {{ ucfirst($key) }}
                    </option>
                  @endforeach
                @endif
              </select>
              <small class="error text-danger status-error"></small>
            </div>
          </div>
          <div class="add-website-message alert d-none mb-4"></div>
          <button type="submit" class="btn btn-primary btn-lg btn-hover text-white add-website-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none add-website-spinner mb-1">
              Add
          </button>
        </form>
      </div>
    </div>
  </div>
</div>