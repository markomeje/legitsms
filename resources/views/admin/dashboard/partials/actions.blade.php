<div class="row">
    <div class="col-12 col-md-4 col-lg-3 mb-4">
      <div class="">
          <button type="submit" class="main-btn m-0 btn-hover w-100 text-white" data-bs-toggle="modal" data-bs-target="#deposit-fund">Deposit fund</button>
          @include('user.deposits.partials.deposit')
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3 mb-4">
      <div class="">
        <button type="submit" class="main-btn m-0 btn-hover w-100 text-white login-button" data-bs-toggle="modal" data-bs-target="#read-sms">Read sms</button>
        @include('user.sms.partials.read')
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3 mb-4">
      <div class="">
        <button type="submit" class="main-btn m-0 btn-hover w-100 text-white" data-bs-toggle="modal" data-bs-target="#generate-number">Generate Number</button>
          @include('user.numbers.partials.generate')
      </div>
    </div>
  </div>