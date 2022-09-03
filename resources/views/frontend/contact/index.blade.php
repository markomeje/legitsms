<div class="frontend-wrapper min-vh-100">
  @include('layouts.header')
  @include('frontend.layouts.navbar')
    <section class="mt-5 pt-5">
      <div class="container mt-5">
        <h3 class="text-white mb-4">Contact Request</h3>
          <div class="row">
              <div class="col-12">
                <form class="contact-form border p-4" action="javascript:;" method="post" data-action="{{ route('contact.send') }}">
                  <div class="row">
                    <div class="form-group input-group-lg col-md-6 mb-3">
                      <label class="text-white">Name</label>
                      <input type="name" name="name" class="form-control name" placeholder="Enter your name">
                      <span class="text-danger name-error"></span>
                    </div>
                    <div class="form-group input-group-lg col-md-6 mb-3">
                      <label class="text-white">Email</label>
                      <input type="email" name="email" class="form-control email" placeholder="Enter your email">
                      <span class="text-danger email-error"></span>
                    </div>
                  </div>
                  <div class="form-group input-group-lg mb-4">
                    <label class="text-white">Message</label>
                    <textarea name="message" rows="4" class="form-control message" placeholder="Enter your message"></textarea>
                    <span class="text-danger message-error"></span>
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg w-100 text-white contact-button mb-4">
                      <img src="/images/spinner.svg" class="mr-2 d-none contact-spinner mb-1">
                      Send
                  </button>
                  <div class="alert px-3 contact-message d-none mb-3"></div>
                </form>
              </div>
            </div>
        </div>
    </section>
</div>
@include('frontend.layouts.footer')
@include('layouts.scripts')