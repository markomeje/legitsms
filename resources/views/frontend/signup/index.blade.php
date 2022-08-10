<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="container mt-5 py-5">
		<div class="row justify-content-center mt-2">
			<div class="col-12 col-md-6">
				<div class="mt-5">
					<div class="p-4 mb-4 bg-white">
						<h3 class="text-primary m-0">Signup Here</h3>
					</div>
					@if(request()->get('success'))
						<div class="alert alert-success mb-4">Your Signup was successfull. Please check your inbox for a verification link. Also check your email Spam folder.</div>
					@else
						<form class="signup-form p-4 bg-white mb-3" method="post" action="javascript:;" data-action="{{ route('signup.auth') }}">
							<p class="text-dark mb-3">Please fill in all fields</p>
							@csrf
							<div class="row">
								<div class="form-group input-group-lg col-md-6 mb-3">
									<label class="text-muted mb-1">Username</label>
									<input type="text" name="username" class="form-control username" placeholder="Enter username">
									<small class="error text-danger username-error"></small>
								</div>
								<div class="form-group input-group-lg col-md-6 mb-3">
									<label class="text-muted mb-1">Email</label>
									<input type="email" name="email" class="form-control email" placeholder="Enter email">
									<small class="error text-danger email-error"></small>
								</div>
							</div>
							<div class="row">
								<div class="form-group input-group-lg col-md-6 mb-3">
									<label class="text-muted mb-1">Password</label>
									<input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
									<small class="error text-danger password-error"></small>
								</div>
								<div class="form-group input-group-lg col-md-6 mb-3">
									<label class="text-muted mb-1">Retype password</label>
									<input type="password" name="retype" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
									<small class="error text-danger retype-error"></small>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<div class="form-check form-switch">
								  	<input class="form-check-input agree" type="checkbox" id="agree" checked name="agree" value="on">
								  	<label class="form-check-label" for="agree">Agree to terms and conditions</label>
								</div>
						    </div>
						    <button type="submit" class="btn btn-primary btn-lg btn-block text-white signup-button mb-4">
						        <img src="/images/spinner.svg" class="mr-2 d-none signup-spinner mb-1">
						        Signup
						    </button>
						    <div class="alert px-3 signup-message d-none mb-3"></div>
						</form>
					@endif
					<div class="p-4 bg-white">
						<p class="text-main-dark mb-0">
							Already have an account? <a class="text-primary font-weight-bolder" href="{{ route('login') }}">Login</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.scripts')