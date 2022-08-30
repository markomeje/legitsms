@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
            <div class="pt-4 px-4 border border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-3">+{{ number_format($websites->count()) }} Websites</h4>
              </div>
              <div>
                <div class="row">
                  <div class="col-12 col-md-4 col-lg-3 mb-4">
                      <button type="button" class="btn btn-primary btn-lg m-0 btn-hover w-100 text-white" data-bs-toggle="modal" data-bs-target="#add-website">Add Website</button>
                      @include('admin.websites.partials.add')
                  </div>
                </div>
              </div>
            </div>
            <section class="section mt-4">
                @if(empty($websites->count()))
                  <div class="alert alert-info">You have no websites yet</div>
                @else
                  <div class="row">
                    @foreach($websites as $website)
                      <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                          @include('admin.websites.partials.card')
                      </div>
                      @include('admin.websites.partials.edit')
                    @endforeach
                  </div>
                  {{ $websites->links('vendor.pagination.default') }}
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')