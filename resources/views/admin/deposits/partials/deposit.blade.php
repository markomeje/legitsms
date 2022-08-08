<!-- Modal -->
<div class="modal fade" id="deposit-fund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deposit fund</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="deposit-fund-form" method="post" action="javascript:;" data-action="{{ route('fund.deposit') }}">
          <div class="form-group input-group-lg mb-4">
            <label class="text-muted mb-2">Amount (NGN1,000 minimum)</label>
            <input type="number" min="1000" name="amount" class="form-control amount" placeholder="Enter amount">
            <small class="error text-danger amount-error"></small>
          </div>
          <div class="deposit-fund-message alert d-none mb-4"></div>
          <button type="submit" class="main-btn w-100 btn-hover text-white deposit-fund-button mb-4">
              <img src="/images/spinner.svg" class="mr-2 d-none deposit-fund-spinner mb-1">
              Pay Now
          </button>
        </form>
      </div>
    </div>
  </div>
</div>