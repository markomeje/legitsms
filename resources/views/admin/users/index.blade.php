@include('layouts.header')
	@include('admin.layouts.aside')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
    	@include('admin.layouts.navbar')
        <div class="container-fluid">
            <div class="p-4 shadow-sm bg-light border-raduis-lg mt-4">
              <div class="">
                <h4 class="text-dark m-0">
                +{{ \App\Models\User::where(['role' => 'user'])->get()->count()  }} Users
              </h4>
              </div>
            </div>
            <section class="section mt-4">
                @if(empty($users))
                  <div class="alert alert-info">No users yet</div>
                @else
                  <div class="row">
                    @foreach($users as $user)
                      <div class="col-xl-3 col-md-4 col-lg-3 col-sm-6 mb-4">
                          @include('admin.users.partials.card')
                      </div>
                    @endforeach
                  </div>
                  {{ $users->links('vendor.pagination.default') }}
                @endif
            </section>
        </div>
    </main>
@include('layouts.scripts')