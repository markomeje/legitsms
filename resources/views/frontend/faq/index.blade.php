<div class="frontend-wrapper min-vh-100">
  @include('layouts.header')
  @include('frontend.layouts.navbar')
    <section class="mt-5 pt-5">
      <div class="container mt-5">
        <h3 class="text-white mb-4">Frequently asked questions</h3>
          @if(empty($faqs->count()))
            <div class="alert alert-danger">No Frequently asked questions</div>
          @else
            <div class="row">
                @foreach($faqs as $faq)
                  <div class="col-12">
                      <div class="accordion accordion-flush" id="faqlist-{{ $faq->id }}">
                          <div class="accordion-item p-3 mb-4">
                              <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $faq->id }}">
                                  {{ $faq->question }}
                                  </button>
                              </h2>
                              <div id="faq-content-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                  <div class="accordion-body">
                                    {{ $faq->answer }}
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                @endforeach
            </div>
          @endif
      </div>
    </section>
    @include('layouts.scripts')
</div>