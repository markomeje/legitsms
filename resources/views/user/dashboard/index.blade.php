<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="mt-5 pt-5">
		<div class="container mt-2">
			<?php $reference = request()->get('reference'); ?>
            @if(!empty($reference))
              <div class="">
                <?php $payment = \App\Utilities\Payment::verify($reference); ?>
                @if($payment['status'] === 1)
                  <div class="alert alert-success mb-4">
                    {{ $payment['info'] }}
                  </div>
                @else
                  <div class="alert alert-danger mb-4">
                    {{ $payment['info'] }}
                  </div>
                @endif
              </div>
            @endif
			<div class="row d-flex flex-sm-row-reverse flex-md-row">
				<div class="col-12 col-md-4 col-lg-3 mb-4">
					<div class="card border mb-4">
						<div class="card-header">Profile</div>
						<div class="card-body p-0">
							<div class="py-4 bg-primary">
								<div class="rounded-circle m-auto mb-4" style="width: 140px; height: 140px;">
									<img src="/images/avatar.png" class="w-100 h-100 rounded-circle">
								</div>
								<div class="text-center">
									<div class="text-white mb-3">
										{{ ucfirst(auth()->user()->username ?? 'Legitsms') }}
									</div>
									<div class="text-white mb-3">
										{{ auth()->user()->email }}
									</div>
									<div class="text-white mb-3">
										Member since {{ auth()->user()->created_at->diffForHumans() }}
									</div>
								</div>
							</div>
							<div class="p-4">
								<div class="mb-3 p-3 bg-light border d-flex align-items-center">
									<div class="me-2">Balance: NGN{{ auth()->user()->account ? number_format(auth()->user()->account->balance) : 0 }}</div>
									@if(!empty($reference))
                    <a href="{{ route('user.dashboard') }}" class="text-decoration-none text-primary px-3 py-1 rounded-pill bg-danger" style="font-size: 8px;">
                      <small class="text-white">Reload</small>
                    </a>
                  @endif
								</div>
								<div class="mb-3 p-3 bg-light border">
									Verifications: {{ auth()->user()->verifications->count() }}
								</div>
								<div class="mb-3 p-3 bg-light border">
									Deposits: NGN{{ number_format(auth()->user()->deposits->sum('amount')) }}
								</div>
							</div>
						</div>
						<div class="card-body text-center py-4">
							<a class="text-center" href="{{ route('logout') }}">Logout</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 col-lg-8 mb-4">
					<div class="card">
						<div class="card-header">{{ config('app.name') }}</div>
						<div class="card-body">
							<nav>
							  <div class="nav nav-tabs" id="nav-tab" role="tablist">
							    <button class="nav-link active" id="nav-deposit-tab" data-bs-toggle="tab" data-bs-target="#nav-deposit" type="button" role="tab" aria-controls="nav-deposit" aria-selected="true">Deposit</button>
							    <button class="nav-link" id="nav-verifications-tab" data-bs-toggle="tab" data-bs-target="#nav-verifications" type="button" role="tab" aria-controls="nav-verifications" aria-selected="false">Verifications</button>
							    <button class="nav-link" id="nav-settings-tab" data-bs-toggle="tab" data-bs-target="#nav-settings" type="button" role="tab" aria-controls="nav-settings" aria-selected="false">Settings</button>
							  </div>
							</nav>
							<div class="tab-content py-4" id="nav-tabContent">
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
									  		@include('user.deposits.partials.table')
										</div>
								  	</div>
							  	</div>
							  <div class="tab-pane fade" id="nav-verifications" role="tabpanel" aria-labelledby="nav-verifications-tab">
							  	<div class="row mb-4">
								  	<div class="col-12">
								  		<div class="card">
								  			<div class="card-body">
								  				<?php $verifications = auth()->user()->verifications; ?>
								  				@if(empty($verifications->count()))
								  					<div class="alert alert-danger m-0">You have no verifications yet.</div>
								  				@else
								  					@include('user.verifications.partials.table')
								  				@endif
								  			</div>
								  		</div>
								  	</div>
								  </div>
							  </div>
							  <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
							  	<div>
							  		<div class="card">
							  			<div class="card-header">Personal</div>
							  			<div class="card-body">
							  				<?php $user = auth()->user(); ?>
							  				<form class="update-personal-form" method="post" action="javascript:;" data-action="{{ route('user.update.personal') }}">
														<div class="form-group input-group-lg mb-3">
															<label class="text-muted mb-1">Username</label>
															<input type="text" name="username" class="form-control username" placeholder="Enter username" value="{{ $user->username }}">
															<small class="error text-danger username-error"></small>
														</div>
														<div class="form-group input-group-lg mb-3">
															<label class="text-muted mb-1">Email</label>
															<input type="email" name="email" class="form-control email" placeholder="Enter email" value="{{ $user->email }}">
															<small class="error text-danger email-error"></small>
														</div>
														<div class="form-group input-group-lg mb-3">
															<label class="text-muted mb-1">Password</label>
															<input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
															<small class="error text-danger password-error"></small>
														</div>
														<button type="submit" class="btn btn-primary btn-lg btn-block text-white update-personal-button mb-4">
										        <img src="/images/spinner.svg" class="mr-2 d-none update-personal-spinner mb-1">
												        Update
												    </button>
										    		<div class="alert px-3 update-personal-message d-none mb-3"></div>
							  				</form>
							  			</div>
							  		</div>
							  	</div>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('layouts.scripts')
</div>