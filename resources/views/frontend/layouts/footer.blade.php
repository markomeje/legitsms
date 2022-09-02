<footer class="footer bg-dark py-4 text-white">
    <div class="container">
      <div class="d-flex justify-content-around flex-wrap">
        <?php $socials = \App\Models\Social::all(); ?>
        @if(!empty($socials->count()))
          @foreach($socials as $social)
            <div class="me-2">
              <i class="icofont-{{ strtolower($social->company) }}"></i>
            </div>
          @endforeach
        @endif
        <div class="">
          Copyright © 2022 {{ config('app.name') }}.
        </div>
        <a href="javascript:;">Cookies Policy</a>
        <a href="javascript:;">Terms of Service</a>
        <a href="javascript:;">Privacy Policy</a>
      </div>
    </div>
</footer>