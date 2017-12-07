    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Select 2 script -->
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <!-- Foundation init -->
    <script>
        $(document).foundation();
            // Select 2 script foundation
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() {
            $('#sign-in').click( function(){
                $('#sign-in').fadeOut();
                $('#create-acc').fadeOut();
                $('#undo').fadeIn().css('display', 'flex');
                $('#sign-in-form').slideDown().css('display', 'block');

                $('#undo').click( function(){
                    $('#undo').fadeOut();
                    $('#sign-in').fadeIn();
                    $('#create-acc').fadeIn();
                    $('#sign-in-form').slideUp().css('display', 'none');
                });
            });
            $('#create-acc').click( function(){
                $('#sign-in').fadeOut();
                $('#create-acc').fadeOut();
                $('#undo').fadeIn().css('display', 'flex');
                $('#create-acc-form').slideDown().css('display', 'block');
                
                $('#undo').click( function(){
                    $('#undo').fadeOut();
                    $('#sign-in').fadeIn();
                    $('#create-acc').fadeIn();
                    $('#create-acc-form').slideUp().css('display', 'none');

                });
            });
        });
    </script>
    