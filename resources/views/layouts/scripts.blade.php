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
                window.location.replace('{{ route('user.dashboard') }}')
            @endif
        @endif

        @if(!empty($verification_id))
            var code = $('.verification-code');
            var loader = $('.verification-loader');
            loader.removeClass('d-none');

            function verificationAsync() {
                console.log('ajax');
                $.ajax({
                    url: '{{ route('verification.read.sms', ['id' => $verification_id]) }}',
                    method: 'post',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if(response.status === 1) {
                            document.getElementById("timer").innerHTML = '00:00';
                            loader.addClass('d-none');
                            code.html(response.code).fadeIn();
                        }else {
                            var fiveMinutes = 60 * 10,
                            display = $('#timer');
                            startTimer(fiveMinutes, display);
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

            function startTimer(duration, display) {
                var timer = duration, minutes, seconds;
                setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.text(minutes + ":" + seconds);

                    if (--timer < 0) {
                        timer = duration;
                    }
                }, 1000);
            }
        @endif
    </script>
</body>
</html>