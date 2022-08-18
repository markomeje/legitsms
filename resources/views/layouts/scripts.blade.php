<!-- ========= All Javascript files linkup ======== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ config('app.url') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('app.url') }}/js/backend.js"></script>
    {{-- Custom Js --}}
    <script src="{{ config('app.url') }}/js/index.js"></script>
    <script src="{{ config('app.url') }}/js/ajax.js"></script>
    <script src="{{ config('app.url') }}/js/forms.js"></script>

    <script type="text/javascript">
        @if(!empty($verifications))
            @foreach($verifications as $verification)
                $('.read-sms-prompt-{{ $verification->id }}').on('click', function() {
                    handleAjax({that: $(this), button: 'read-sms-button-{{ $verification->id }}', spinner: 'read-sms-spinner-{{ $verification->id }}'});    
                });
            @endforeach
        @endif

        @if(!empty($payment) && !empty($reference))
            @if(1 == $payment['status'] ?? '')
                window.location.href = {{ route('user.dashboard') }}
            @endif
        @endif

        @if(!empty($verification_id))
            var code = $('.verification-code');
            var loader = $('.verification-loader');
            loader.removeClass('d-none');

            function verificationAsync() {
                $.ajax({
                    url: {{ route('verification.read.sms') }},
                    method: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 1) {
                            loader.addClass('d-none');
                            code.html(response.code).fadeIn();
                        }

                        setTimeout(function() {
                            verificationAsync();
                        }, 30000);
                    },

                    error: function(response) {

                    }
                 });
            }

            verificationAsync();
        @endif
    </script>
</body>
</html>