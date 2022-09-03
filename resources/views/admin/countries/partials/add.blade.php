<!-- Modal -->
<div class="modal fade" id="add-country" tabindex="-1" aria-labelledby="country-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="country-modal">Add Country</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-country-form" method="post" action="javascript:;" data-action="{{ route('admin.country.add') }}">
          <div class="row">
            <div class="form-group input-group-lg col-12 col-md-6 mb-4">
              <label class="text-muted mb-2">Country name</label>
              <input type="text" name="name" class="form-control name" placeholder="Enter name">
              <small class="error text-danger name-error"></small>
            </div>
            <div class="form-group input-group-lg col-12 col-md-6 mb-4">
              <label class="text-muted mb-2">ID number</label>
              <input type="text" name="id_number" class="form-control id_number" placeholder="Enter id number">
              <small class="error text-danger id_number-error"></small>
            </div>
          </div>
          <div class="add-country-message alert d-none mb-4"></div>
          <button type="submit" class="btn btn-primary btn-lg btn-hover text-white add-country-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none add-country-spinner mb-1">
              Add
          </button>
        </form>
      </div>
    </div>
  </div>
</div>