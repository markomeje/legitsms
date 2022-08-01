@include('layouts.header')
  @include('frontend.layouts.navbar')
<!-- ======== hero-section start ======== -->
    <section class="pt-50">
      <div class="container">
        <h3 class="text-dark mb-4">Frequently asked questions</h3>
          <div class="row">
              <div class="col-12">
                  <div class="accordion accordion-flush" id="faqlist">
                      <div class="accordion-item p-3 mb-4">
                          <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                              What is Lorem Ipsum?
                              </button>
                          </h2>
                          <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                              <div class="accordion-body">
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                              </div>
                          </div>
                      </div>

                      <div class="accordion-item p-3 mb-4">
                          <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                              Why do we use it?
                              </button>
                          </h2>
                          <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                              <div class="accordion-body">
                                  It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here.
                              </div>
                          </div>
                      </div>

                      <div class="accordion-item p-3 mb-4">
                          <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                              Where does it come from?
                              </button>
                          </h2>
                          <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                              <div class="accordion-body">
                                  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                              </div>
                          </div>
                      </div>

                      <div class="accordion-item p-3 mb-4">
                          <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                              Where does it come from?
                              </button>
                          </h2>
                          <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                              <div class="accordion-body">
                                  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                              </div>
                          </div>
                      </div>

                      <div class="accordion-item p-3 mb-4">
                          <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                              Where does it come from?
                              </button>
                          </h2>
                          <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                              <div class="accordion-body">
                                  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
    @include('frontend.layouts.footer')
@include('layouts.scripts')