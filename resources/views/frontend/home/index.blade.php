@include('layouts.header')
  @include('frontend.layouts.navbar')
<!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6 mb-4">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
                Do you need an SMS verification? 
              </h1>
              <p class="wow fadeInUp" data-wow-delay=".6s">We provide fully automated SMS verifications for any website or Mobile app</p>
              <a
                href="{{ route('signup') }}"
                class="main-btn border-btn btn-hover wow fadeInUp"
                data-wow-delay=".6s"
                >Get Started</a>
            </div>
          </div>
          <div class="col-lg-6 mb-4">
            <div class="wow fadeInUp" data-wow-delay=".5s">
              {{-- <img src="/images/logic.png" class="img-fluid" alt="" /> --}}
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="features" class="pt-120">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-sm-10 mb-5">
            <div class="">
              <div class="features-icon" style="">
                <i class="lni lni-bootstrap"></i>
              </div>
              <div class="content">
                <h3>Automated Easily</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10 mb-5">
            <div class="">
              <div class="features-icon" style="">
                <i class="lni lni-layout"></i>
              </div>
              <div class="content">
                <h3>Clean Design</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10 mb-5">
            <div class="">
              <div class="features-icon" style="">
                <i class="lni lni-coffee-cup"></i>
              </div>
              <div class="content">
                <h3>Simply Easy</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <!-- ======== about-section start ======== -->
    <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row align-items-center pb-5">
          <div class="col-xl-6 col-lg-6">
            <div class="about-img">
              <img src="/saaspal/images/about/about-1.png" alt="" class="w-100 img-fluid" />
              <img
                src="/saaspal/images/about/about-left-shape.svg"
                alt=""
                class="shape shape-1 img-fluid"
              />
              {{-- <img
                src="/saaspal/images/about/left-dots.svg"
                alt=""
                class="shape shape-2 img-fluid"
              /> --}}
            </div>
          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Verify automatically in any website or app
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  dinonumy eirmod tempor invidunt ut labore et dolore magna
                  aliquyam erat, sed diam voluptua.
                </p>
              </div>
              <a
                href="{{ route('signup') }}"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Get Started</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== about-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="why" class="feature-extended-section pt-100">
      <div class="feature-extended-wrapper">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-9">
              <div class="section-title text-center mb-60">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Why Choose {{ config('app.name') }}?
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore et dolore
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="-extended">
                <div class="features-icon" style="">
                  <i class="lni lni-display"></i>
                </div>
                <div class="content">
                  <h3>SaaS Focused</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="-extended">
                <div class="features-icon" style="">
                  <i class="lni lni-leaf"></i>
                </div>
                <div class="content">
                  <h3>Awesome Design</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="-extended">
                <div class="features-icon" style="">
                  <i class="lni lni-grid-alt"></i>
                </div>
                <div class="content">
                  <h3>Ready to Use</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="-extended">
                <div class="features-icon" style="">
                  <i class="lni lni-javascript"></i>
                </div>
                <div class="content">
                  <h3>Vanilla JS</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="-extended">
                <div class="features-icon" style="">
                  <i class="lni lni-layers"></i>
                </div>
                <div class="content">
                  <h3>Essential Sections</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="-extended">
                <div class="features-icon" style="">
                  <i class="lni lni-rocket"></i>
                </div>
                <div class="content">
                  <h3>Highly Optimized</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <!-- ======== subscribe-section start ======== -->
    <section id="contact" class="subscribe-section pt-120">
      <div class="container">
        <div class="subscribe-wrapper img-bg">
          <div class="row flex-column">
            <div class="col-12 col-md-8 col-lg-7 mb-4">
              <div class="section-title mb-15">
                <h2 class="text-white mb-20">Verification Automated Immediately</h2>
                <p class="text-white pr-5">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor
                </p>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5">
              <a href="{{ route('signup') }}" class="main-btn bg-white text-primary btn-hover">
                Signup
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    @include('frontend.layouts.footer')
@include('layouts.scripts')