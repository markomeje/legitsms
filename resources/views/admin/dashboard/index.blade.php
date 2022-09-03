@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
          <?php $reference = request()->get('reference'); ?>
            @if(!empty($reference))
              <div class="mt-4">
                <?php $payment = \App\Utilities\Payment::verify($reference); ?>
                @if($payment['status'] === 1)
                  <div class="alert alert-success m-0">
                    {{ $payment['info'] }}
                  </div>
                @else
                  <div class="alert alert-danger m-0">
                    {{ $payment['info'] }}
                  </div>
                @endif
              </div>
            @endif
            <div class="p-4 border-0 bg-white shadow-sm border-raduis-lg mt-4">
              <h4 class="text-dark mb-2">Total Deposits</h4>
              <h3 class="d-flex align-items-center">
                <div class="text-muted me-2">NGN{{ number_format(\App\Models\Deposit::all()->sum('amount')) }}</div>
              </h3>
            </div>
            <section class="section mt-4">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.users') }}">Users</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\User::where(['role' => 'user'])->get()->count()  }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.countries') }}">Countries</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Country::count()  }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.websites') }}">Websites</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Website::count() }}
                          </h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                      <div class="icon-card mb-30">
                        <div class="icon purple">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                          <h6 class="mb-10">
                            <a href="{{ route('admin.faqs') }}">Faqs</a>
                          </h6>
                          <h5 class="text-bold mb-10">
                            +{{ \App\Models\Faq::count() }}
                          </h5>
                        </div>
                      </div>
                    </div>
                </div>
            </section>
            <section class="socials">
              <div class="">
                <div class="bg-dark text-white p-4 d-flex justify-content-between mb-4">
                    <span>Social media handles</span>
                    <a href="button" class="text-white" data-bs-toggle="modal" data-bs-target="#add-social">
                      <i class="icofont-plus"></i>
                    </a>
                    @include('admin.socials.partials.add')
                </div>
                <div class="">
                  <?php $socials = \App\Models\Social::all(); ?>
                  @if(empty($socials->count()))
                    <div class="alert alert-info mb-4">No social media handles</div>
                  @else
                    <div class="row">
                      @foreach($socials as $social)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                          @include('admin.socials.partials.social')
                        </div>
                        @include('admin.socials.partials.edit')
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
            </section>
            <section class="legal">
              <div>
                <div class="bg-dark text-white p-4 d-flex justify-content-between mb-4">
                    <span>Cookies and Privacy Policy. Terms of User</span>
                </div>
                <?php $legal = \App\Models\Legal::where('id', '>', 0)->first(); ?>
                @if(empty($legal))
                  <form class="add-legal-form" method="post" action="javascript:;" data-action="{{ route('admin.legal.add') }}">
                    <div class="form-group col-12 mb-4">
                      <label class="mb-2 text-bold">Cookies policy</label>
                      <textarea class="form-control cookies description" name="cookies"></textarea>
                      <small class="cookies-error text-danger"></small>
                    </div>
                    <div class="form-group col-12 mb-4">
                      <label class="mb-2 text-bold">Terms of Service</label>
                      <textarea class="form-control terms description" name="terms"></textarea>
                      <small class="terms-error text-danger"></small>
                    </div>
                    <div class="form-group col-12 mb-4">
                      <label class="mb-2 text-bold">Privacy policy</label>
                      <textarea class="form-control privacy description" name="privacy"></textarea>
                      <small class="privacy-error text-danger"></small>
                    </div>
                    <div class="add-legal-message alert d-none mb-4"></div>
                    <button type="submit" class="btn btn-primary btn-lg btn-hover text-white add-legal-button mb-4">
                        <img src="/images/spinner.svg" class="mr-2 d-none add-legal-spinner mb-1">
                        Add
                    </button>
                  </form>
                @else
                  <form class="edit-legal-form" method="post" action="javascript:;" data-action="{{ route('admin.legal.edit', ['id' => $legal->id]) }}">
                    <div class="form-group col-12 mb-4">
                      <label class="mb-2 text-bold">Cookies policy</label>
                      <textarea class="form-control cookies description" name="cookies">{{ $legal->cookies }}</textarea>
                      <small class="cookies-error text-danger"></small>
                    </div>
                    <div class="form-group col-12 mb-4">
                      <label class="mb-2 text-bold">Terms of Service</label>
                      <textarea class="form-control terms description" name="terms">{{ $legal->terms }}</textarea>
                      <small class="terms-error text-danger"></small>
                    </div>
                    <div class="form-group col-12 mb-4">
                      <label class="mb-2 text-bold">Privacy policy</label>
                      <textarea class="form-control privacy description" name="privacy">{{ $legal->privacy }}</textarea>
                      <small class="privacy-error text-danger"></small>
                    </div>
                    <div class="edit-legal-message alert d-none mb-4"></div>
                    <button type="submit" class="btn btn-primary btn-lg btn-hover text-white edit-legal-button mb-4">
                        <img src="/images/spinner.svg" class="mr-2 d-none edit-legal-spinner mb-1">
                        Save
                    </button>
                  </form>
                @endif
              </div>
            </section>
        </div>
    </main>
@include('layouts.scripts')