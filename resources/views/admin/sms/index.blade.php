@include('layouts.header')
	@include('user.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('user.layouts.navbar')
        <div class="container-fluid">
            <?php $sms = auth()->user()->sms; ?>
            <div class="pt-4 px-4 border border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark mb-3">+{{ number_format($sms->count()) }} Read Sms</h4>
              </div>
              <div>
                @include('user.dashboard.partials.actions')
              </div>
            </div>
            <section class="section mt-4">
                @if(empty($sms))
                  <div class="alert alert-info">You have no sms yet</div>
                @else
                  <div class="row">
                    @foreach($sms as $text)
                      <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                          @include('user.sms.partials.card')
                      </div>
                    @endforeach
                  </div>
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')