<div class="frontend-wrapper min-vh-100">
  @include('layouts.header')
  @include('frontend.layouts.navbar')
    <section class="mt-5 pt-5">
      <div class="container mt-5">
        <h3 class="text-white mb-4">Our Terms of Service</h3>
          @if(empty($terms))
            <div class="alert alert-danger">Terms of Service not available yet</div>
          @else
            {!! $terms !!}
          @endif
      </div>
    </section> 
</div>
@include('frontend.layouts.footer')
@include('layouts.scripts')