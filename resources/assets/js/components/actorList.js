$.fn.actorList = function() {
    var self = this;

    var existingActorChooser = this.find(".js-existing-actor-chooser");
    var existingActorAdd = this.find(".js-existing-actor-add");
    var myActors = [];

    existingActorAdd.click(function(e) {
        e.preventDefault();

        var selectedData = existingActorChooser.select2('data')[0];
        var actor = {
            id: selectedData.id, 
            name: selectedData.text
        };

        addActor(myActors, actor);
        updateList(myActors);
    });

    function updateList (myActors) {
        var list = self.find(".js-my-actors-list");
        $('.js-my-actors-list li').remove();

        $.each(myActors, function(index, actor) {
            var el = $(
                '<li>'+
                '<h3 class="my-actors-name">'+actor.name+'</h3>'+
                '<button class="button secondary js-remove-my-actor">X</button>'+
                '</li>'
            );

            list.append(el);
            el.find(".js-remove-my-actor").click(function(e) {
                e.preventDefault();

                removeActor(myActors, actor);
            });
        });
    }

    function removeActor (myActors, actor) {

        var position = myActors.indexOf(actor);
        myActors.splice(position, 1);

        console.log(myActors);
        updateList(myActors);
    }

    function addActor (myActors, actor) {
        var exists = false;
        myActors.forEach(function(actorInList){
            if (actorInList.id === actor.id) {
                exists = true;
            }
        });

        if (exists) {
            return;
        }

        myActors.push(actor);    
    }
};



$(".js-actor-list").actorList();