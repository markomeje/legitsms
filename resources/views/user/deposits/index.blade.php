@include('layouts.header')
	@include('user.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('user.layouts.navbar')
        <div class="container-fluid">
            <?php $deposits = \App\Models\Deposit::where(['user_id' => auth()->id(), 'deposited' => true, 'status' => 'paid']); ?>
            <div class="pt-4 px-4 border border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-2">Total Deposits</h4>
                <h3 class="mb-3 d-flex align-items-center">
                  <div class="text-muted me-2">NGN{{ number_format($deposits->sum('amount')) }}</div>
                </h3>
              </div>
              <div>
                @include('user.dashboard.partials.actions')
              </div>
            </div>
            <section class="section mt-4">
                <?php $deposits = $deposits->get(); ?>
                @if(empty($deposits))
                  <div class="alert alert-info">You have no deposits yet</div>
                @else
                  <div class="row">
                    @foreach($deposits as $deposit)
                      <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                          @include('user.deposits.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')