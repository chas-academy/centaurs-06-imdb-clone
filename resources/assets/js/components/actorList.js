$.fn.actorList = function() {
    var self = this;

    var existingActorChooser = this.find(".js-existing-actor-chooser");
    var existingActorAdd = this.find(".js-existing-actor-add");
    var removeMyActor = this.find(".js-remove-my-actor");
    var myActors = [];

    existingActorAdd.click(function(e) {
        e.preventDefault();

        var selected = existingActorChooser.select2('data')[0];
        myActors.push(selected);
        updateList(myActors);
    });

    function updateList (myActors) {
        var list = self.find(".js-my-actors-list");
        $('.js-my-actors-list li').remove();

        $.each(myActors, function(index, actor) {
            var el = $(
                '<li>'+
                '<h3 class="my-actors-name">'+actor.text+'</h3>'+
                '<button class="button secondary js-remove-my-actor">X</button>'+
                '</li>'
            );

            el.click(function(e) {
                e.preventDefault();
            });

            list.append(el);
        });
    }

    function removeActor (myActors) {
        removeMyActor.click(function(e){
            e.preventDefault();

        });
    }
};



$(".js-actor-list").actorList();