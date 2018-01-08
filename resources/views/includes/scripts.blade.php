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
        $('#sortByGenreSelect').change(function(){
            let selectedGenre = $('#sortByGenreSelect').val();

            if(selectedGenre === '')
            {

            }
            else
            {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    method: 'POST',
                    url: '/sortbygenre/updatemovies',
                    data: {selectedGenre},
                    dataType: 'json',
                    success: function(response)
                    {  
                        let movies = response
                        let moviePoster = $('.movie-poster').remove();
                        for(var i in movies)
                        {
                        let html = 
                        '<div class="movie-poster">' +
                            '<div class="movie-rating">' +
                                '<p class="rating-num">' + movies[i].imdb_rating +'</p>' +
                                '<i class="fa fa-star" aria-hidden="true"></i>' +
                            '</div>' +
                            '<a href="movie/'+ movies[i].id+'" class="none">' +
                                '<img src="https://image.tmdb.org/t/p/w500/'+ movies[i].poster +'" class="poster-size">' +
                            '</a>'
                        '</div>';
                        let movieSortedPoster = $('.flex-align-sb-c').append(html)
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });
            }
        });
        //Initialize person (actor/producer..) handling
        //$(function() {
        //    $(".js-personlist").each(function(index, el) {
        //        el = $(el);
        //        el.personList({
        //            dataField: el.data('field'),
        //        });
        //    });
        //});
    </script>