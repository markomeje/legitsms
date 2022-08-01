<!-- Modal -->
<div class="modal fade" id="resend-verification-link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resend Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="resend-verification-link-form" method="post" action="javascript:;" data-action="{{ route('signup.link.resend') }}">
          <div class="form-group input-group-lg mb-4">
            <label class="text-muted mb-2">Your email</label>
            <input type="email" name="email" class="form-control email" placeholder="Enter email">
            <small class="error text-danger email-error"></small>
          </div>
          <div class="resend-verification-link-message alert d-none mb-4"></div>
          <button type="submit" class="main-btn w-100 btn-hover text-white resend-verification-link-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none resend-verification-link-spinner mb-1">
              Resend
          </button>
        </form>
      </div>
    </div>
  </div>
</div>