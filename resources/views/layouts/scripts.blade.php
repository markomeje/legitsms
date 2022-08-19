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

                $('.blacklist-prompt-{{ $verification->id }}').on('click', function() {
                    handleAjax({that: $(this), button: 'blacklist-button-{{ $verification->id }}', spinner: 'blacklist-spinner-{{ $verification->id }}'});    
                });
            @endforeach
        @endif

        @if(!empty($payment) && !empty($reference))
            @if(1 == $payment['status'] ?? '')
                window.location.replace('{{ route('user.dashboard') }}')
            @endif
        @endif

        @if(!empty($verification_id))
            var code = $('.verification-code-{{ $verification_id }}');
            var loader = $('.verification-loader-{{ $verification_id }}');
            loader.removeClass('d-none');

            function verificationAsync() {
                $.ajax({
                    url: '{{ route('verification.read.sms', ['id' => $verification_id]) }}',
                    method: 'post',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if(response.response !== undefined) {
                            loader.addClass('d-none');
                            code.html(response.response).fadeIn();
                            console.log(response.response);
                        }else {
                            setTimeout(function() {
                                verificationAsync();
                            }, 30000);
                        }    
                    },

                    error: function(response) {
                        alert('Unknown error.')
                    }
                 });
            }

            verificationAsync();

        @endif
    </script>
</body>
</html>