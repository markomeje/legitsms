@include('frontend.layouts.header')
<div class="bg-light-sky min-vh-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-5">
				<div class="mt-5">
					<form class="signup-form p-4 bg-white" method="post" action="javascript:;" data-action="{{ route('signup.auth') }}">
						@csrf
						<h3 class="text-primary mb-4">Signup Here</h3>
						<div class="row">
							<div class="form-group col-md-6 mb-3">
								<label class="text-muted mb-1">Username</label>
								<input type="text" name="username" class="form-control username" placeholder="Enter username">
								<small class="error text-danger username-error"></small>
							</div>
							<div class="form-group col-md-6 mb-3">
								<label class="text-muted mb-1">Email</label>
								<input type="email" name="email" class="form-control email" placeholder="Enter email">
								<small class="error text-danger email-error"></small>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6 mb-3">
								<label class="text-muted mb-1">Password</label>
								<input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
								<small class="error text-danger password-error"></small>
							</div>
							<div class="form-group col-md-6 mb-3">
								<label class="text-muted mb-1">Retype password</label>
								<input type="password" name="retype" class="form-control retype" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
								<small class="error text-danger retype-error"></small>
							</div>
						</div>
						<div class="d-flex align-items-center justify-content-between mb-3">
					    	<div class="custom-control custom-switch">
							  	<input type="checkbox" class="custom-control-input agree" id="agree" name="agree" value="on">
							  	<label class="custom-control-label cursor-pointer" for="agree">
							  		<small class="text-main-dark">Agree to terms and conditions</small>
							  	</label>
							</div>
					    </div>
					    <button type="submit" class="main-btn btn-hover btn-block text-white signup-button mb-4">
					        <img src="/images/spinner.svg" class="mr-2 d-none signup-spinner mb-1">
					        Signup
					    </button>
					    <div class="alert px-3 signup-message d-none mb-3"></div>
					    <p class="text-main-dark mb-0">
							Already have an account? <a class="text-primary font-weight-bolder" href="{{ route('login') }}">Login</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
@include('frontend.layouts.footer')