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
                <h3 class="mb-3 text-muted">
                  NGN{{ auth()->user()->account ? number_format(auth()->user()->account->balance) : 0 }}
                  @if(!empty($reference))
                    <a href="{{ route('user.dashboard') }}" class="text-decoration-none text-primary">
                      <i class="icofont-refresh"></i>
                    </a>
                  @endif
                </h3>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-4">
                  <div class="">
                      <button type="submit" class="main-btn m-0 btn-hover w-100 text-white login-button" data-bs-toggle="modal" data-bs-target="#deposit-fund">Deposit fund</button>
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
                            <a href="">Total Deposits</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            NGN{{ number_format(\App\Models\Deposit::where(['user_id' => auth()->id(), 'deposited' => true])->sum('amount')) }}
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
                            <a href="">All Verifications</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ '45'  }}
                          </h5>
                        </div>
                      </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@include('layouts.scripts')