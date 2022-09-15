<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="mt-5 pt-5">
		<div class="container mt-5">
			<div class="row d-flex flex-sm-row-reverse flex-md-row">
				<div class="col-12 col-md-7 col-lg-5 mb-4">
					<div class="card mb-4">
						<?php $globe = request()->get('countries') ?? ''; $code = request()->get('code') ?? 'UK'; ?>
						<div class="card-header d-flex justify-content-between">
							<div class="text-dark">
								Sms Verification
							</div>
						</div>
						<div class="card-body">
							<?php $countries = empty($globe) ? \App\Models\Country::paginate(20) : \App\Models\Country::all() ; ?>
							@if(empty($countries))
								<div class="alert alert-danger m-0">No countries available</div>
							@else
								<div class="row">
									@foreach($countries as $country)
										<div class="col-12 col-md-6 mb-2">
										<?php $id_number = $country->id_number; ?>
											<a href="{{ route('home', ['code' => $id_number, 'countries' => $globe]) }}#country-websites" class="d-flex align-items-center w-100 {{ $code == $id_number ? 'bg-primary text-white px-1' : 'text-dark' }}">
												<div class="me-2">
													<i class="cflag cflag-{{ \Str::slug($country->name) }}" alt="{{ $country->name }}"></i>
												</div>
												<h5 class="font-weight-bolder m-0">
													{{ ucfirst($country->name) }}
												</h5>
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
						<a name="country-websites"></a>
						<div class="card-body">
							<?php $websites = \App\Models\Website::all(); $limit = 10; $total = 0; ?>
							@if(empty($websites->count()))
								<div class="alert alert-danger m-0">No websites listed</div>
							@else
							    <?php $search = request()->get('search'); $shaw = request()->get('shaw'); ?>
								<form action="" method="get" class="d-flex mb-3">
							        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ $search ?? '' }}">
							        <button class="btn btn-success" type="submit">Search</button>
							    </form>
							    <?php $country = \App\Models\Country::where(['id_number' => $code])->first(); ?>
							    @if(empty($search))
							    	<?php 
							    		if(empty($shaw)) {
							    			$websites = $country->websites()->paginate($limit);
							    			$total = $websites->total();
							    		}else {
							    			$websites = $country->websites;
							    		}
							    	?>
							    @else
							     	<?php 
							     		$results = \App\Models\Website::query()->where('name', 'LIKE', "%{$search}%")->orWhere('code', 'LIKE', "%{$search}%");
							     		if(empty($shaw)) {
							    			$websites = $results->paginate($limit);
							    			$total = $websites->total();
							    		}else {
							    			$websites = $results->get();
							    		}
							     	?>
							    @endif
							    @if(empty($websites->count()))
							    	@if(!empty($search))
							    		<div class="alert alert-danger">No websites found for your search.</div>
							    	@else
							     		<div class="alert alert-danger">No websites available.</div>
							     	@endif
							    @else
									<div class="accordion" id="accordionExample">
										@foreach($websites as $website)
										  @include('frontend.home.partials.countries')
										@endforeach
									</div>
								@endif	
							@endif
						</div>
						@if(empty($shaw) && $total > $limit)
							<div class="card-footer">
								<a href="{{ route('home', ['code' => $code, 'countries' => $globe, 'shaw' => true, 'search' => $search]) }}#country-websites">Show all</a>
							</div>
						@endif
					</div>
				</div>
				<div class="col-12 col-md-5 col-lg-7 mb-4">
					<?php $verification_id = request()->get('id'); ?>
					@if(empty($verification_id))
						<div class="card border-0">
							<div class="card-header bg-dark">
								<a class="navbar-brand" href="{{ route('home') }}" style="width: 180px;">
							          <img src="/images/logo-lite.png" alt="logo" class="img-fluid" />
							        </a>
							</div>
							<div class="card-body">
								<h3 class="text-dark mb-4">Do you need a SMS verification? Stop looking.</h3>
								<div class="text-muted mb-3">We have been providing fully automated SMS verifications for any website for you.</div>
								<div class="text-muted">You no longer have to risk getting called in the middle of the night because you provided your own phone number when signed up to a website.</div>
							</div>
						</div>
					@else
						<?php $verification = \App\Models\Verification::find($verification_id); ?>
						@if(empty($verification))
							<div class="alert alert-danger mb-3">Verification not found.</div>
							<a href="{{ route('user.dashboard') }}" class="btn btn-primary">Go to Dashboard.</a>
						@else
							<div class="card">
								<div class="card-body">
									<div class="table-responsive table-responsive-sm">
								  		<table class="table table-striped table-hover">
										  <thead>
										    <tr>
										      <th scope="col">Timer</th>
										      <th scope="col">Country</th>
										      <th scope="col">Website</th>
										      <th scope="col">Phone</th>
										      <th scope="col">Code</th>
										      <th scope="col">Action</th>
										    </tr>
										  </thead>
											 <tbody>
											    @include('user.verifications.partials.tr')
											</tbody>
										</table>
									</div>
								</div>
							</div>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
	@include('frontend.layouts.footer')
	@include('layouts.scripts')
</div>