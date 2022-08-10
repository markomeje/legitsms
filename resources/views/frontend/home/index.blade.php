<div class="frontend-wrapper min-vh-100">
	@include('layouts.header')
	@include('frontend.layouts.navbar')
	<div class="mt-5 pt-5">
		<div class="container mt-2">
			<div class="row d-flex flex-sm-row-reverse flex-md-row">
				<div class="col-12 col-md-5 col-lg-4 mb-4">
					<div class="card mb-4">
						<div class="card-header">Sms Verification</div>
						<div class="card-body">
							<?php $countries = \App\Models\Country::paginate($all ?? 20); ?>
							@if(empty($countries))
								<div class="alert alert-danger m-0">No countries available</div>
							@else
								@foreach($countries as $country)
									<?php $iso2 = strtolower($country->iso2); ?>
									<a href="{{ route('home.country', ['code' => $iso2]) }}" class="d-flex align-items-center w-100">
										<div class="me-2">
											<img src="https://flagcdn.com/w20/{{ $iso2 }}.png" srcset="https://flagcdn.com/w40/{{ $iso2 }}.png 2x" width="20" alt="{{ ucwords($country->name) }}" class="border h-100 object-cover">
										</div>
										<div class="text-dark">
											{{ ucfirst($country->name) }}
										</div>
									</a>
								@endforeach
							@endif
						</div>
						<div class="card-footer">
							<a href="{{ route('home.countries', ['all' => 250]) }}">Show all</a>
						</div>
					</div>
					<div class="card mb-4">
						<div class="card-header">Sms Verification</div>
						<div class="card-body">
							<?php $websites = \App\Models\Website::all(); ?>
							@if(empty($websites))
								<div class="alert alert-danger m-0">No websites available</div>
							@else
								<div class="accordion" id="accordionExample">
									@foreach($websites as $website)
									<?php $code = request()->get('code'); $country = empty($code) ? \App\Models\Country::where('id', '>', 0)->first() : \App\Models\Country::where(['iso2' => $code])->first(); ?>
									  <div class="accordion-item">
									    <h2 class="accordion-header" id="heading-{{ $website->id }}">
									      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $website->id }}" aria-expanded="true" aria-controls="collapse-{{ $website->id }}">
									        <div class="d-flex align-items-center justify-content-between w-100">
									        	<div class="d-flex align-items-center">
									        		<div class="me-2">
														<img src="https://flagcdn.com/w20/{{ strtolower($country->iso2) }}.png" srcset="https://flagcdn.com/w40/{{ strtolower($country->iso2) }}.png 2x" width="20" alt="{{ ucwords($website->name) }}" class="border h-100 object-cover">
													</div>
													<div class="text-dark">
														{{ ucfirst($website->name) }}
													</div>
									        	</div>
												<div>
													NGN{{ number_format($website->price) }}
												</div>	
											</div>
									      </button>
									    </h2>
									    <div id="collapse-{{ $website->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $website->id }}" data-bs-parent="#accordionExample">
									      <div class="accordion-body">
									      	@if(auth()->check())
										      	<div class="verify-sms-prompt" data-url="{{ route('verification.process', ['website_id' => $website->id, 'country_id' => $country->id]) }}">
										      		<button class="btn btn-block w-100 text-white btn-primary verify-sms-button">
											      		<img src="/images/spinner.svg" class="mr-2 d-none verify-sms-spinner mb-1">
											      		Verify {{ ucwords($country->name) }} Number
											      	</button>
										      	</div>
									      	@else
									      		<a href="{{ route('login') }}" class="btn btn-dark w-100">Please Login to continue</a>
									      	@endif
									      </div>
									    </div>
									  </div>
									@endforeach
								</div>	
							@endif
						</div>
						<div class="card-footer"></div>
					</div>
				</div>
				<div class="col-12 col-md-7 col-lg-8 mb-4">
					<?php $id = request()->get('id'); ?>
					@if(empty($id))
						<div class="card">
							<div class="card-header">{{ config('app.name') }}</div>
							<div class="card-body">
								<h3 class="text-dark mb-4">Do you need a SMS verification? Stop looking.</h3>
								<div class="text-muted mb-3">We have been providing fully automated SMS verifications for any website for you.</div>
								<div class="text-muted">You no longer have to risk getting called in the middle of the night because you provided your own phone number when signed up to a website.</div>
							</div>
						</div>
					@else
						<?php $verification = \App\Models\Verification::find($id); ?>
						@if(empty($verification))
							<div class="alert alert-danger mb-3">Verification not found.</div>
							<a href="{{ route('user.dashboard') }}">Go to Dashboard.</a>
						@else
							<div class="card">
								<div class="card-body">
									<div class="table-responsive table-responsive-sm">
								  		<table class="table table-striped table-hover">
										  <thead>
										    <tr>
										      <th scope="col">Country</th>
										      <th scope="col">Website</th>
										      <th scope="col">Phone</th>
										      <th scope="col">Action</th>
										    </tr>
										  </thead>
											  <tbody>
											    <tr>
											      <td>
											      	{{ $verification->country->name }}
											      </td>
											      <td>
											      	{{ $verification->website->name }}
											      </td>
											      <td>
											      	<a href="tel:{{ ucfirst($verification->phone) }}">{{ ucfirst($verification->phone) }}</a>
											      </td>
											      <td>
											      	<div class="">Read Sms</div>
											      </td>
											    </tr>
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
	@include('layouts.scripts')
</div>