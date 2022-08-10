<div class="tab-pane fade show active" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
  	<div class="row mb-4">
	  	<div class="col-12 col-md-6">
	  		<div class="pb-3">
	  			<div class="mb-4 bg-primary text-white border p-3">
	  				Balance NGN{{ auth()->user()->account ? number_format(auth()->user()->account->balance) : 0 }}
	  			</div>
	  			<div class="mb-3 border p-3">
	  				Card Deposit
	  			</div>
	  			<div class="">Card payment is automatically verified after payment. Please wait for redirect when payment is successfull</div>
	  		</div>
	  	</div>
	  	<div class="col-12 col-md-6">
	  		<form class="deposit-fund-form p-4 border rounded" method="post" action="javascript:;" data-action="{{ route('fund.deposit') }}">
	          <div class="form-group input-group-lg mb-4">
	            <label class="text-muted mb-2">Amount (NGN1,000 minimum)</label>
	            <input type="number" min="1000" name="amount" class="form-control amount" placeholder="Enter amount">
	            <small class="error text-danger amount-error"></small>
	          </div>
	          <div class="deposit-fund-message alert d-none mb-4"></div>
	          <button type="submit" class="btn btn-primary btn-lg w-100 text-white deposit-fund-button mb-4">
	              <img src="/images/spinner.svg" class="mr-2 d-none deposit-fund-spinner mb-1">
	              Deposit Now
	          </button>
	        </form>
	  	</div>
  	</div>
  	<div class="card">
  		<div class="card-header">Deposits Invoices</div>
  		<div class="card-body">
	  		<div class="table-responsive table-responsive-sm">
		  		<table class="table table-striped table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Ref</th>
				      <th scope="col">Amount</th>
				      <th scope="col">Status</th>
				      <th scope="col">Date</th>
				    </tr>
				  </thead>
				  <?php $sn = 1; $deposits = auth()->user()->deposits; ?>
				  @if(empty($deposits->count()))
				  	<div class="alert alert-danger m-0">No deposits available</div>
				  @else
					  <tbody>
					  	@foreach($deposits as $deposit)
						    <tr>
						      <th scope="row">
						      	{{ $sn++ }}
						      </th>
						      <td>
						      	{{ \Str::limit($deposit->refernce, 12) }}
						      </td>
						      <td>
						      	{{ number_format($deposit->amount) }}
						      </td>
						      <td>
						      	{{ ucfirst($deposit->status) }}
						      </td>
						      <td>
						      	{{ $deposit->created_at->diffForHumans() }}
						      </td>
						    </tr>
					    @endforeach
					</tbody>
				   @endif
				</table>
			</div>
		</div>
  	</div>
	</div>