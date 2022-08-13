@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
          <?php $reference = request()->get('reference'); ?>
            @if(!empty($reference))
              <div class="mt-4">
                <?php $payment = \App\Utilities\Payment::verify($reference); ?>
                @if($payment['status'] === 1)
                  <div class="alert alert-success m-0">
                    {{ $payment['info'] }}
                  </div>
                @else
                  <div class="alert alert-danger m-0">
                    {{ $payment['info'] }}
                  </div>
                @endif
              </div>
            @endif
            <div class="pt-4 px-4 border border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-2">Total Funds</h4>
                <h3 class="mb-3 d-flex align-items-center">
                  <div class="text-muted me-2">NGN{{ number_format(\App\Models\Account::all()->sum('balance')) }}</div>
                </h3>
              </div>
              {{-- <div>
                @include('user.dashboard.partials.actions')
              </div> --}}
            </div>
            <section class="section mt-4">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.users') }}">Users</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\User::count()  }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.deposits') }}">Deposits</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Deposit::count()  }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.verifications') }}">Verifications</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Sms::count()  }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.websites') }}">Websites</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Website::count() }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.countries') }}">Countries</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Country::count() }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.faqs') }}">Faqs</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Faq::count() }}
                          </h5>
                        </div>
                      </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@include('layouts.scripts')