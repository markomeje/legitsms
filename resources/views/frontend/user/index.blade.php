<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="mt-5 pt-5">
		<div class="container mt-2">
			<div class="row d-flex flex-sm-row-reverse flex-md-row">
				<div class="col-12 col-md-4 col-lg-3 mb-4">
					<div class="card border mb-4">
						<div class="card-header">Profile</div>
						<div class="card-body py-4 bg-primary">
							<div class="rounded-circle m-auto mb-4" style="width: 140px; height: 140px;">
								<img src="/images/avatar.png" class="w-100 h-100 rounded-circle">
							</div>
							<div class="text-center">
								<div class="text-white">
									{{ auth()->user()->name ?? 'Legitsms' }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 col-lg-8 mb-4">
					<div class="card">
						<div class="card-header">{{ config('app.name') }}</div>
						<div class="card-body">
							<h3 class="text-dark mb-4">Do you need a SMS verification? Stop looking.</h3>
							<div class="text-muted mb-3">We have been providing fully automated SMS verifications for any website for you.</div>
							<div class="text-muted">You no longer have to risk getting called in the middle of the night because you provided your own phone number when signed up to a website.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('layouts.scripts')
</div>