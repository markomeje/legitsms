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
                <h1 class="mb-3 text-muted">NGN{{ auth()->user()->account ? number_format(auth()->user()->account->balance) : 0 }}</h1>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-4">
                  <div class="">
                      <button type="submit" class="main-btn m-0 btn-hover w-100 text-white login-button" data-bs-toggle="modal" data-bs-target="#deposit-fund">Deposit</button>
                      @include('user.deposits.partials.deposit')
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                  <div class="">
                    <button type="submit" class="main-btn m-0 btn-hover w-100 text-white login-button">Verify</button>
                  </div>
                </div>
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
                            <a href="">Referrals</a>
                          </h6>
                          <h3 class="text-bold mb-10">+04</h3>
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
                            <a href="">Deposits</a>
                          </h6>
                          <h3 class="text-bold mb-10">
                            NGN{{ number_format(auth()->user()->deposits->sum('amount')) }}
                          </h3>
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
                            <a href="">Verifications</a>
                          </h6>
                          <h3 class="text-bold mb-10">
                            +{{ '45'  }}
                          </h3>
                        </div>
                      </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@include('layouts.scripts')