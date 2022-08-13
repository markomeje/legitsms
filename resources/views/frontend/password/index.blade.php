<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="container mt-5 pt-5">
		<div class="row align-items-center mt-2">
			@if(request()->get('token'))
				<div class="col-12 col-md-5">
					<div class="alert alert-success">Please check your email to proceed</div>
				</div>
			@else
				<div class="col-12 col-md-8 col-lg-6">
					<h3 class="text-white mb-3">Enter Email</h3>
					<div class="text-white mb-3">Enter your account email and you will recieve a password reset link in your email.</div>
					<form method="post" action="javascript:;" class="forgot-password-form p-4 shadow-sm icon-raduis bg-white" data-action="{{ route('password.reset.process') }}" autocomplete="off">
	                    <div class="form-group input-group-lg">
	                        <label class="text-muted font-weight-bold">Email</label>
	                        <input type="email" class="form-control email rounded-0" name="email" placeholder="e.g., email@email.com">
	                        <small class="invalid-feedback email-error"></small>
	                    </div>
	                    <div class="alert mb-3 forgot-password-message d-none"></div>
	                    <div class="mb-3 mt-4">
	                        <button type="submit" class="btn bg-primary text-white forgot-password-button px-4">
	                            <img src="/images/spinner.svg" class="mr-2 d-none forgot-password-spinner mb-1">
	                            Submit
	                        </button>
	                    </div>
		            </form>
				</div>
	        @endif
		</div>
	</div>
@include('layouts.scripts')
</div>