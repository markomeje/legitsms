@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
            <div class="pt-4 px-4 border border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-2">All  Countries</h4>
                <h3 class="mb-3 d-flex align-items-center">
                  <div class="text-muted me-2">{{ \App\Models\Country::count() }}</div>
                </h3>
              </div>
            </div>
            <section class="section mt-4">
                <?php $countries = \App\Models\Country::paginate(20); ?>
                @if(empty($countries))
                  <div class="alert alert-info">You have no countries yet</div>
                @else
                  <div class="row">
                    @foreach($countries as $country)
                      <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                          @include('admin.countries.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')