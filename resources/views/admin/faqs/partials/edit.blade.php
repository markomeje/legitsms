<!-- Modal -->
<div class="modal fade" id="edit-faq-{{ $faq->id }}" tabindex="-1" aria-labelledby="faq-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="faq-modal">Add Faq</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="edit-faq-form" method="post" action="javascript:;" data-action="{{ route('admin.faq.edit', ['id' => $faq->id]) }}">
          <div class="row">
            <div class="form-group input-group-lg col-12 mb-4">
              <label class="text-muted mb-2">question</label>
              <textarea name="question" class="form-control question" placeholder="Enter question">{{ $faq->question }}</textarea>
              <small class="error text-danger question-error"></small>
            </div>
            <div class="form-group input-group-lg col-12 mb-4">
              <label class="text-muted mb-2">Answer</label>
              <textarea name="answer" rows="4" class="form-control answer" placeholder="Enter answer">{{ $faq->answer }}</textarea>
              <small class="error text-danger answer-error"></small>
            </div>
          </div>
          <div class="edit-faq-message alert d-none mb-4"></div>
          <button type="submit" class="btn btn-primary btn-lg btn-hover text-white edit-faq-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none edit-faq-spinner mb-1">
              Edit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>