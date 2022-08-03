@include('layouts.header')
<div class="bg-light-sky min-vh-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4">
				<div class="my-5">
					<div class="p-4 bg-white mb-4">
						<h3 class="m-0 text-dark">Welcome to <a href="{{ route('home') }}" class="text-primary">Legitsms</a></h3>
					</div>
					<form class="login-form p-4 bg-white mb-4" method="post" action="javascript:;" data-action="{{ route('login.auth') }}">
						@csrf
						<div class="row mb-2">
							<div class="form-group input-group-lg col-12 mb-3">
								<label class="text-muted mb-1">Email</label>
								<input type="email" name="email" class="form-control email" placeholder="Enter email">
								<small class="error text-danger email-error"></small>
							</div>
							<div class="form-group input-group-lg col-12 mb-3">
								<label class="text-muted mb-1">Password</label>
								<input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
								<small class="error text-danger password-error"></small>
							</div>
						</div>
					    <button type="submit" class="main-btn btn-hover w-100 text-white login-button mb-4">
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
</div>
@include('layouts.scripts')