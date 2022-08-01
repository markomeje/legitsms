@include('layouts.header')
	@include('user.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('user.layouts.navbar')
        <div class="container-fluid">
            <div class="pt-4 px-4 border mt-4">
              <div class="">
                <div>Account balance</div>
                <h1>{{ auth()->user()->account->balance }}</h1>
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
                            <a href="">Balance</a>
                          </h6>
                          <h3 class="text-bold mb-10">$90</h3>
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
                          <h3 class="text-bold mb-10">$120</h3>
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
                          <h3 class="text-bold mb-10">+45</h3>
                        </div>
                      </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@include('layouts.scripts')