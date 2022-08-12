@include('layouts.header')
  @include('frontend.layouts.navbar')
    <section class="mt-5 pt-5">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 mb-4">
            @if(request()->get('resent'))
              <div class="alert alert-success mb-0">Verification link resent. Please check your email and also your email Spam folder.</div>
            @else
              <div class="">
                <?php $user = \App\Models\User::where(['token' => $token])->first(); ?>
                @if(empty($user))
                  <div class="alert alert-danger mb-0">Invalid verification link. <a href="javascript:;" class="text-primary" data-bs-toggle="modal" data-bs-target="#resend-verification-link">Click here</a> to resend link</div>
                  @include('frontend.signup.resend')
                @elseif(\Carbon\Carbon::parse($user->expiry)->diffInMinutes(\Carbon\Carbon::now()) > 180)
                  <div class="alert alert-danger mb-0">Expired verification link. <a href="javascript:;" class="text-primary" data-bs-toggle="modal" data-bs-target="#resend-verification-link">Click here</a> to resend link</div> 
                  @include('frontend.signup.resend')
                @else
                    <?php $user->verified = true; $user->token = null; $user->expiry = null; $user->status = 'active'; $user->update(); ?>
                    <div class="alert alert-success mb-0">Verification successfull. <a href="{{ route('login') }}">Login here</a></div>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    @include('frontend.layouts.footer')
@include('layouts.scripts')