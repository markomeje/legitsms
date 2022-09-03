<div class="frontend-wrapper min-vh-100">
  @include('layouts.header')
  @include('frontend.layouts.navbar')
    <section class="mt-5 pt-5">
      <div class="container mt-5">
        <h3 class="text-white mb-4">Our Cookies Policy</h3>
          @if(empty($cookies))
            <div class="alert alert-danger">Cookies Policy not available yet</div>
          @else
            {!! $cookies !!}
          @endif
      </div>
    </section> 
</div>
@include('frontend.layouts.footer')
@include('layouts.scripts')