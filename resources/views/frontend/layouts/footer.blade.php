<footer class="footer bg-dark py-4 text-white">
    <div class="container">
      <div class="d-flex justify-content-around flex-wrap">
        <?php $socials = \App\Models\Social::all(); ?>
        @if(!empty($socials->count()))
          <div class="d-flex align-items-center">
            @foreach($socials as $social)
              <a target="_blank" class="me-2" href="{{ $social->link }}">
                <i class="icofont-{{ strtolower($social->company) }}"></i>
              </a>
            @endforeach
          </div>
        @endif
        <div class="">
          Copyright © 2022 {{ config('app.name') }}.
        </div>
        <div>
          <a href="javascript:;" class="me-2">Cookies Policy</a>
          <a href="javascript:;" class="me-2">Terms of Service</a>
          <a href="javascript:;" class="">Privacy Policy</a>
        </div>
      </div>
    </div>
</footer>