@include('frontend.layouts.header')
  @include('frontend.layouts.navbar')
<!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
                Do you need an SMS verification? 
              </h1>
              <p class="wow fadeInUp" data-wow-delay=".6s">We provide fully automated SMS verifications for any website or Mobile app</p>
              <a
                href="javascript:void(0)"
                class="main-btn border-btn btn-hover wow fadeInUp"
                data-wow-delay=".6s"
                >Get Started</a
              >
              <a href="#features" class="scroll-bottom">
                <i class="lni lni-arrow-down"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="wow fadeInUp" data-wow-delay=".5s">
              <img src="/images/logic.svg" class="img-fluid" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="features" class="feature-section pt-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-bootstrap"></i>
              </div>
              <div class="content">
                <h3>Bootstrap 5</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
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
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-coffee-cup"></i>
              </div>
              <div class="content">
                <h3>Easy to Use</h3>
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
        <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6">
            <div class="about-img">
              <img src="/saaspal/images/about/about-1.png" alt="" class="w-100 img-fluid" />
              <img
                src="/saaspal/images/about/about-left-shape.svg"
                alt=""
                class="shape shape-1 img-fluid"
              />
              <img
                src="/saaspal/images/about/left-dots.svg"
                alt=""
                class="shape shape-2 img-fluid"
              />
            </div>
          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Thrive automatically with choice website or app
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  dinonumy eirmod tempor invidunt ut labore et dolore magna
                  aliquyam erat, sed diam voluptua.
                </p>
              </div>
              <a
                href="javascript:void(0)"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Discover More</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== about-section end ======== -->

    <!-- ======== about2-section start ======== -->
    <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Easy to Use with Tons of Awesome Features
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore et dolore magna
                  aliquyam erat, sed diam voluptua.
                </p>
              </div>
              <a
                href="javascript:void(0)"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Learn More</a
              >
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 order-first order-lg-last">
            <div class="about-img-2">
              <img src="/saaspal/images/about/about-2.png" alt="" class="w-100 img-fluid" />
              <img
                src="/saaspal/images/about/about-right-shape.svg"
                alt=""
                class="shape shape-1 img-fluid"
              />
              {{-- <img
                src="/saaspal/images/about/right-dots.svg"
                alt=""
                class="shape shape-2 img-fluid"
              /> --}}
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== about2-section end ======== -->

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
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
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
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
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
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
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
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
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
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
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
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
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
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-7">
              <div class="section-title mb-15">
                <h2 class="text-white mb-25">Subscribe Our Newsletter</h2>
                <p class="text-white pr-5">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor
                </p>
              </div>
            </div>
            <div class="col-xl-6 col-lg-5">
              <form action="#" class="subscribe-form">
                <input
                  type="email"
                  name="subs-email"
                  id="subs-email"
                  placeholder="Your Email"
                />
                <button type="submit" class="main-btn btn-hover">
                  Subscribe
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    @include('frontend.layouts.bottom')
    <!-- ======== scroll-top ======== -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>
    <!-- ======== subscribe-section end ======== -->
@include('frontend.layouts.footer')