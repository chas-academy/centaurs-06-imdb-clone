    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Select 2 script -->
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <!-- Foundation init -->
    <script>
        $(document).foundation();
        $(document).ready(function() 
        {
            // Select 2 script foundation
            $('.js-example-basic-single').select2();
            // Event listener for buttons in settings menu
            $('#sign-in').click(function(){menuSettingsHandler('in');});
            $('#sign-up').click(function(){menuSettingsHandler('up');});
        });
        // Function for handling the click
        function menuSettingsHandler(v)
        {
            $('#mobile-btn-wrap').toggle();
                $('#mobile-btn-back').css('display', 'flex');
                $('#sign-'+v+'-f').css('display', 'block');
                if($('#sign-'+v+'-f').css('display') == 'block')
                {
                    $('#mobile-btn-quit').hide();
                    $('#mobile-btn-back').click (function(e){
                        $('#mobile-btn-quit').show();
                        $('#mobile-btn-back').hide();
                        $('#sign-'+v+'-f').css('display', 'none');
                        $('#mobile-btn-wrap').css('display', 'block');
                    });
                }               
        }

        // Initialize person (actor/producer..) handling
        $(function() {
            $(".js-personlist").each(function(index, el) {
                el = $(el);
                el.personList({
                    dataField: el.data('field'),
                });
            });
        });
    </script>