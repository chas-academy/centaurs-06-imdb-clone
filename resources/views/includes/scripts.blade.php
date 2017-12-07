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
    </script>
    