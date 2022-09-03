@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
            <div class="p-4 bg-white shadow-sm border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-3">+{{ \App\Models\Country::count() }}  Countries</h4>
                <div class="row">
                  <div class="col-12 col-md-4 col-lg-3">
                      <button type="button" class="btn btn-primary btn-lg m-0 btn-hover w-100 text-white" data-bs-toggle="modal" data-bs-target="#add-country">Add Country</button>
                  </div>
                </div>
              </div>
                @include('admin.countries.partials.add')
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
                      @include('admin.countries.partials.edit')
                    @endforeach
                  </div>
                  {{ $countries->links('vendor.pagination.default') }}
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')