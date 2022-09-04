<!-- ========= All Javascript files linkup ======== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ config('app.url') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('app.url') }}/js/backend.js"></script>
    {{-- Custom Js --}}
    <script src="{{ config('app.url') }}/js/index.js"></script>
    <script src="{{ config('app.url') }}/js/ajax.js"></script>
    <script src="{{ config('app.url') }}/js/forms.js"></script>

    @if(config('app.env') === 'production')
        <script src="//code.tidio.co/zkxbfhkokgtbwluy4jx6g4h0iz3ggyml.js" async></script>
    @endif

    <!-- Summernote -->
    <script src="{{ config('app.url') }}/summernote/summernote-lite.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        var description = $('.description');
        if (description) {
            description.summernote({
                tabsize: 4,
                height: 400
            });
        }

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
            
            function startTimer(duration, display) {
                var start = Date.now(),
                    diff,
                    minutes,
                    seconds;
                function timer() {
                    // get the number of seconds that have elapsed since 
                    // startTimer() was called
                    diff = duration - (((Date.now() - start) / 1000) | 0);

                    // does the same job as parseInt truncates the float
                    minutes = (diff / 60) | 0;
                    seconds = (diff % 60) | 0;

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = minutes + ":" + seconds; 

                    if (diff <= 0) {
                        display.textContent = "00:00"; 
                        return;
                        // add one second so that the count down starts at the full duration
                        // example 05:00 not 04:59
                        start = Date.now() + 1000;
                    }
                };
                // we don't want to wait a full second before the timer starts
                timer();
                var intervalId = setInterval(timer, 1000);
                // setTimeout(function() {
                //     clearInterval(intervalId);
                //     display.textContent = "00:00"; 
                // }, duration);
            }

            var display = document.querySelector('#timer-active');
            if (display) {
                var tenMinutes = 10 * 60;
                startTimer(tenMinutes, display);
            }

            var code = $('.verification-code-{{ $verification_id }}');
            var loader = $('.verification-loader-{{ $verification_id }}');
            var timer = $('.verification-timer-{{ $verification_id }}');
            loader.removeClass('d-none');

            function verificationAsync() {
                $.ajax({
                    url: '{{ route('verification.read.sms', ['id' => $verification_id]) }}',
                    method: 'post',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var status = response.status || 0;
                        if(status == 1){
                            loader.addClass('d-none');
                            code.html(response.code).fadeIn();
                            console.log(response.code);

                        }else if(status == -1) {
                            loader.addClass('d-none');
                            code.html(response.info).fadeIn();
                            // code.html(response.info).fadeIn();
                            console.log(response.info);

                        }else {
                            setTimeout(function() {
                                verificationAsync();
                            }, 20000);
                        }    
                    },

                    error: function(response) {}
                 });
            }

            verificationAsync();

        @endif
    </script>
</body>
</html>