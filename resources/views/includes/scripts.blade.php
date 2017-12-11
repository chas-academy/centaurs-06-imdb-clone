    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Select 2 script -->
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <!-- Foundation init -->
    <script>
        $(document).foundation();
            // Select 2 script foundation
        $(document).ready(function() 
        {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() 
        {
            // Mobile-animations 
            $('#sign-in').click( function(e){
                $('#mobile-btn-wrap').toggle();
                $('#mobile-btn-back').css('display', 'flex');
                $('#sign-in-f').css('display', 'block');
                if($('#sign-in-f').css('display') == 'block')
                {
                    $('#mobile-btn-quit').hide();
                    $('#mobile-btn-back').click (function(e){
                        $('#mobile-btn-quit').show();
                        $('#mobile-btn-back').hide();
                        $('#sign-in-f').css('display', 'none');
                        $('#mobile-btn-wrap').css('display', 'block');
                    });
                }               
            });
            $('#sign-up').click( function(e){
                $('#mobile-btn-wrap').toggle();
                $('#mobile-btn-back').css('display', 'flex');
                $('#sign-up-f').css('display', 'block');
                if($('#sign-up-f').css('display') == 'block')
                {
                    $('#mobile-btn-quit').hide();
                    $('#mobile-btn-back').click (function(e){
                        $('#mobile-btn-quit').show();
                        $('#mobile-btn-back').hide();
                        $('#sign-up-f').css('display', 'none');
                        $('#mobile-btn-wrap').css('display', 'block');
                    });
                }
            });
        });
    </script>