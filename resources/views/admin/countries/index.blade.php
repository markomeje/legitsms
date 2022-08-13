@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
            <div class="p-4 bg-white shadow-sm border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-2">All  Countries</h4>
                <h3 class="m-0 d-flex align-items-center">
                  <div class="text-muted me-2">{{ $countries->count() }}</div>
                </h3>
              </div>
            </div>
            <section class="section mt-4">
                @if(empty($countries->count()))
                  <div class="alert alert-info">You have no countries yet</div>
                @else
                  <div class="row">
                    @foreach($countries as $country)
                      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                          @include('admin.countries.partials.card')
                      </div>
                    @endforeach
                  </div>
                  {{ $countries->links('vendor.pagination.default') }}
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')