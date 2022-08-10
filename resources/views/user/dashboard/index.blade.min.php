@include('layouts.header')
	@include('user.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('user.layouts.navbar')
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
                <h4 class="text-dark mb-2">Account balance</h4>
                <h3 class="mb-3 d-flex align-items-center">
                  <div class="text-muted me-2">NGN{{ auth()->user()->account ? number_format(auth()->user()->account->balance) : 0 }}</div>
                  @if(!empty($reference))
                    <a href="{{ route('user.dashboard') }}" class="text-decoration-none text-primary px-3 py-1 rounded-pill bg-danger" style="font-size: 8px;">
                      <small class="text-white">Reload</small>
                    </a>
                  @endif
                </h3>
              </div>
              <div>
                @include('user.dashboard.partials.actions')
              </div>
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
                            <a href="">All Referrals</a>
                          </h6>
                          <h5 class="text-bold mb-10">+04</h5>
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
                            <a href="{{ route('user.deposits') }}">My Deposits</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ auth()->user()->deposits->count()  }}
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
                            <a href="{{ route('user.sms') }}">All Sms</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ auth()->user()->sms->count()  }}
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
                            <a href="">Phone Numbers</a>
                          </h6>
                          <h5 class="text-bold mb-10">+04</h5>
                        </div>
                      </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@include('layouts.scripts')