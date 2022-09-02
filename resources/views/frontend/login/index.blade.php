<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="container mt-5 pt-5">
		<div class="row justify-content-center mt-2">
			<div class="col-12 col-md-6 col-lg-4">
				<div class="my-5">
					<div class="p-4 bg-white mb-4">
						<h3 class="m-0 text-dark">Login Here</h3>
					</div>
					<form class="login-form p-4 bg-white mb-4" method="post" action="javascript:;" data-action="{{ route('login.auth') }}">
						@csrf
						<div class="row mb-2">
							<div class="form-group input-group-lg col-12 mb-3">
								<label class="text-muted mb-1">Username</label>
								<input type="username" name="username" class="form-control username" placeholder="Enter username">
								<small class="error text-danger username-error"></small>
							</div>
							<div class="form-group input-group-lg col-12 mb-3">
								<label class="text-muted d-flex justify-content-between mb-1">
									<span>Password</span>
									<a href="{{ route('forgot.password') }}">
										<small>Forgot password?</small>
									</a>
								</label>
								<input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
								<small class="error text-danger password-error"></small>
							</div>
						</div>
						<div class="mb-3">
							<div class="form-check form-switch cursor-pointer">
							  	<input class="form-check-input rememberme" type="checkbox" id="rememberme" checked>
							  	<label class="form-check-label" for="rememberme">Remember Login</label>
							</div>
							<small class="error text-danger rememberme-error"></small>
						</div>
					    <button type="submit" class="btn btn-primary btn-lg w-100 text-white login-button mb-4">
					        <img src="/images/spinner.svg" class="mr-2 d-none login-spinner mb-1">
					        Login
					    </button>
					    <div class="alert px-3 login-message d-none mb-3"></div>
					</form>
					<div class="p-4 bg-white">
						<p class="text-main-dark mb-0">
							Don't have an account? <a class="text-primary font-weight-bolder" href="{{ route('signup') }}">Signup</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@include('layouts.scripts')
</div>