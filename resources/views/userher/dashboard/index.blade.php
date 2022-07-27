<div class="dashboard">
  @include('user.layouts.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('user.layouts.aside')
      <main class="main-content position-relative border-radius-lg ">
        @include('user.layouts.navbar')
      <div class="container-fluid py-4">
        <div class="mb-4">
          <h4 class="m-0 text-white">Welcome Here</h4>
        </div>
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
              <div class="card">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <a href="">
                          <p class="text-sm mb-0 font-weight-bold">
                            My Payments
                          </p>
                        </a>
                        <h5 class="font-weight-bolder">
                          ${{ rand(34, 140) }}
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        @if(empty($forms))
          <div class="alert alert-info border-0">No froms available</div>
        @else
          <div class="row mt-4">
            @foreach($forms as $key => $form)
              <div class="col-12 col-md-6 col-lg-3 mb-4">
                @include('user.forms.partials.card')
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </main>
    @include('user.layouts.rightbar')
  @include('user.layouts.footer')
</div>