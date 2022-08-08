@include('layouts.header')
	@include('user.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('user.layouts.navbar')
        <div class="container-fluid">
            <?php $numbers = \App\Models\Number::where(['user_id' => auth()->id(), 'responded' => true, 'status' => 'done']); ?>
            <div class="pt-4 px-4 border border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-3">+{{ number_format($numbers->count()) }} Phone Numbers</h4>
              </div>
              <div>
                @include('user.dashboard.partials.actions')
              </div>
            </div>
            <section class="section mt-4">
                <?php $numbers = $numbers->get(); ?>
                @if(empty($numbers))
                  <div class="alert alert-info">You have no numbers yet</div>
                @else
                  <div class="row">
                    @foreach($numbers as $number)
                      <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                          @include('user.numbers.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')