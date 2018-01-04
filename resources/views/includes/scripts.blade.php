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
            $('.sort-genre').select2({
                placeholder: "Sort by genres",
                closeOnSelect: false,
                maximumInputLength: 15,
                maximumSelectionLength: 4
            });
            
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

        let genres = [];
        function changeSelect(event)
        {
            let genres = $(event.target).val();
            $("#genres").val(genres);
            var form = document.getElementById('submitGenre');
            form.submit();
            // const payload =
            //     genres
            //         .map(g => `genres[]=${g}`)
            //         .join('&');

            // fetch('/genres/?' + JSON.stringify(payload))
            //     .then(res => res.json())
            //     .then(res => console.log(res));

        }
      
    </script>