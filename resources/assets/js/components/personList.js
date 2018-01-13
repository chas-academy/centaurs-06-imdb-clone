$.fn.personList = function(config) {
    var self = this;
    var myPersons = [];


    var dataField = config.dataField || 'persons';

    var existingPersonChooser = self.find(".js-personlist-existing-person-chooser");
    var existingPersonAdd = self.find(".js-personlist-existing-person-add");
    var newPersonChooser = self.find(".js-personlist-new-person-field");
    var newPersonAdd = self.find(".js-personlist-new-person-add");

    myPersons = self.data('initial');
    //fallback ifall ingen data
    //döpa om val till choices
    updateList();

    existingPersonAdd.click(function(e) {
        e.preventDefault();

        var selectedData = existingPersonChooser.select2('data')[0];
        var person = {
            id: selectedData.id, 
            name: selectedData.text,
        };

        addPerson(person);
        updateList();
    });

    newPersonAdd.click(function(e) {
        e.preventDefault();

        selectedName = self.find('.js-personlist-new-person-field').val();
        selectedName = _.trim(selectedName);

        if (!selectedName) {
            return;
        }

        var person = {
            id: null,
            name: selectedName,
        };        
        
        addPerson(person);
        updateList();

    });

    function addPerson (person) {
        var exists = false;

        myPersons.forEach(function(personInList){
            if (personInList.id+personInList.name === person.id+person.name) {
                exists = true;
            }
        });

        if (exists) {
            return;
        }

        myPersons.push(person);    
    }

    function updateList () {
        var list = self.find(".js-personlist-choices");
        list.find("> li").remove();

        $.each(myPersons, function(index, person) {
            var existing = Boolean(person.id);

            var el = $(
                '<li>'+
                '<h3>'+person.name+'</h3>'+
                '<button class="button secondary js-personlist-remove">X</button>'+
                '<input type="hidden" name="'+(existing ? dataField+'[]' : dataField+'_new[]')+'" value="'+(existing ? person.id : person.name)+'" />'+
                '</li>'
            );

            list.append(el);
            el.find(".js-personlist-remove").click(function(e) {
                e.preventDefault();

                removePerson(myPersons, person);
            });
        });
    }

    function removePerson (person) {
        var position = myPersons.indexOf(person);
        myPersons.splice(position, 1);

        updateList(myPersons);
    }
}