<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="mt-5 pt-5">
		<div class="container mt-2">
			<div class="row d-flex flex-sm-row-reverse flex-md-row">
				<div class="col-12 col-md-7 col-lg-5 mb-4">
					<div class="card mb-4">
						<?php $globe = request()->get('countries') ?? ''; ?>
						<div class="card-header d-flex justify-content-between">
							<div class="text-dark">
								Sms Verification
							</div>
						</div>
						<div class="card-body">
							<?php $countries = empty($globe) ? \App\Models\Country::paginate(50) : \App\Models\Country::all() ; ?>
							@if(empty($countries))
								<div class="alert alert-danger m-0">No countries available</div>
							@else
								<div class="row">
									@foreach($countries as $country)
										<div class="col-12 col-md-6 mb-2">
										<?php $iso2 = strtolower($country->iso2); $id_number = $country->id_number; ?>
											<a href="{{ route('home', ['code' => $id_number, 'countries' => $globe]) }}" class="d-flex align-items-center w-100 {{ request()->get('code') == $id_number ? 'bg-primary text-white px-1' : 'text-dark' }}">
												<div class="me-2">
													<i class="cflag cflag-{{ \Str::slug($country->name) }}" alt="{{ $country->name }}"></i>
												</div>
												<small class="">
													{{ ucfirst($country->name) }}
												</small>
											</a>
										</div>
									@endforeach
								</div>
									
							@endif
						</div>
						@if(empty($globe))
							<div class="card-footer">
								<a href="{{ route('home', ['countries' => 'true']) }}">Show all</a>
							</div>
						@endif
					</div>
					<div class="card mb-4">
						<div class="card-header">Sms Verification</div>
						<div class="card-body">
							<?php $code = request()->get('code'); $country = \App\Models\Country::where(['id_number' => $code])->first() ?>
							<?php $websites = \App\Models\Website::all(); ?>
							@if(empty($websites))
								<div class="alert alert-danger m-0">No websites listed</div>
							@else
								
							     <?php $code = request()->get('code'); ?>
							     @if(!empty($code))
							     	<?php $country = \App\Models\Country::where(['id_number' => $code])->first(); ?>
							     	@if(empty($country->websites->count()))
							     		<div class="alert alert-danger">No websites listed for {{ $country->name }}</div>
							     	@else
							     		<div class="accordion" id="accordionExample">
											@foreach($country->websites as $website)
											  @include('frontend.home.partials.countries')
											@endforeach
										</div>
							     	@endif
							     @else
								     <?php 
								     	$search = request()->get('search'); 
								     	if(!empty($search)) {
								     		session(['search' => $search]);
								     		$websites = \App\Models\Website::query()->where('name', 'like', "%{$search}%")->get(); 
								     	} 
								     ?>
									<form action="" method="get" class="d-flex mb-3">
								        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ $search ?? '' }}">
								        <button class="btn btn-success" type="submit">Search</button>
								     </form>

								     @if(!empty($search) && empty($websites->count()))
								     	<div class="alert alert-danger">No result found.</div>
								     @endif

									<div class="accordion" id="accordionExample">
										@foreach($websites as $website)
										<?php $country = \App\Models\Country::where('id', '>', 0)->first(); ?>
										  @include('frontend.home.partials.countries')
										@endforeach
									</div>
								@endif	
							@endif
						</div>
					</div>
				</div>
				<div class="col-12 col-md-5 col-lg-7 mb-4">
					<?php $verification_id = request()->get('id'); ?>
					@if(empty($verification_id))
						<div class="card">
							<div class="card-header">{{ config('app.name') }}</div>
							<div class="card-body">
								<h3 class="text-dark mb-4">Do you need a SMS verification? Stop looking.</h3>
								<div class="text-muted mb-3">We have been providing fully automated SMS verifications for any website for you.</div>
								<div class="text-muted">You no longer have to risk getting called in the middle of the night because you provided your own phone number when signed up to a website.</div>
							</div>
						</div>
					@else
						@if(auth()->check())
							<?php $verifications = \App\Models\Verification::latest('created_at')->where(['user_id' => auth()->id()])->get(); ?>
							@if(empty($verifications->count()))
								<div class="alert alert-danger mb-3">Verification not found.</div>
								<a href="{{ route('user.dashboard') }}" class="btn btn-primary">Go to Dashboard.</a>
							@else
								<div class="card">
									<div class="card-body">
										<div class="table-responsive table-responsive-sm">
									  		<table class="table table-striped table-hover">
											  <thead>
											    <tr>
											      {{-- <th scope="col">Time</th> --}}
											      <th scope="col">Country</th>
											      <th scope="col">Website</th>
											      <th scope="col">Phone</th>
											      <th scope="col">Code</th>
											      <th scope="col">Action</th>
											    </tr>
											  </thead>
												  <tbody>
												  	@foreach($verifications as $verification)
												    	@include('user.verifications.partials.tr')
												    @endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							@endif
						@else
							<div class="alert alert-danger">Please login to continue</div>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
	@include('layouts.scripts')
</div>