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
        // Special Sorting
        $('#sortBySpecSorting, #sortBySpecDesktop').change(function(){
            
            let selectedSpecSorting = $('#sortBySpecSorting').val() || $('#sortBySpecDesktop').val();

            if (selectedSpecSorting !== '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    method: 'POST',
                    url: '/sortbyspec/update',
                    data: {selectedSpecSorting},
                    dataType: 'json',
                    success: function(response)
                    {  
                        let movies = response;
                        let moviePoster = $('.movie-poster').remove();
                        for (let i in movies)
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

        // Sorting By Genre those two sorting function will be combined into one if it is possible(This is for later).
        $('#sortByGenreSelect, #sortByGenreDesktop').change(function(){
            let selectedGenre = $('#sortByGenreSelect').val() || $('#sortByGenreDesktop').val();

            if(selectedGenre !== '') {
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
                        for(let i in movies)
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
        $(function() {
           $(".js-personlist").each(function(index, el) {
               el = $(el);
               el.personList({
                   dataField: el.data('field'),
               });
           });
        });

        // Alert when adding a movie from TMDB to our database
        $('.confirm').on('click', function () {
            return confirm('Are you sure you want to add this movie to Centaurs-imdb?');
        });
        // Alert when adding a tvshow from TMDB to our database
        $('.confirm-tv').on('click', function () {
            return confirm('Are you sure you want to add this tvshow to Centaurs-imdb?\n\nWhen adding tvshows with many episodes/seasons the process can take a long time! \n\n Go and take a nice cup of coffe while you wait :)');
        });
        
        
        // Slider
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1} 
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none"; 
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block"; 
        dots[slideIndex-1].className += " active";
        }
    </script>