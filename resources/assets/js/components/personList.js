$.fn.personList = function(config) {
    var self = this;
    var myPersons = self.data('initial') || [];
    var dataField = config.dataField || 'persons';

    var existingPersonChooser = self.find(".js-personlist-existing-person-chooser");
    var existingPersonAdd = self.find(".js-personlist-existing-person-add");
    var newPersonChooser = self.find(".js-personlist-new-person-field");
    var newPersonAdd = self.find(".js-personlist-new-person-add");

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

        var field = self.find('.js-personlist-new-person-field');

        selectedName = field.val();
        selectedName = _.trim(selectedName);

        if (!selectedName) {
            return;
        }

        var person = {
            id: null,
            name: selectedName,
        };

        if (personExists(person)) {
            return;
        }

        addPerson(person);
        updateList();

        field.val("");

    });


    function addPerson (person) {
        if (personExists(person)) {
            return;
        }

        myPersons.push(person);
    }

    function personExists(person) {
        var exists = false;

        myPersons.forEach(function(personInList){
            if (personInList.id+personInList.name === person.id+person.name) {
                exists = true;
            }
        });

        return exists;
    }

    function updateList () {
        var list = self.find(".js-personlist-choices");
        list.find("> li").remove();

        $.each(myPersons, function(index, person) {
            var existing = Boolean(person.id);

            var el = $(
                '<li class="personlist-item">'+
                '<p class="personlist-item-title">'+person.name+'</p>'+
                '<button class="js-personlist-remove personlist-remove"><i class="fa fa-times-circle fa-1x" aria-hidden="true"></i></button>'+
                '<input type="hidden" name="'+(existing ? dataField+'[]' : dataField+'_new[]')+'" value="'+(existing ? person.id : person.name)+'" />'+
                '</li>'
            );

            list.append(el);
            el.find(".js-personlist-remove").click(function(e) {
                e.preventDefault();

                removePerson(person);
            });
        });
    }

    function removePerson (person) {
        var position = myPersons.indexOf(person);

        myPersons.splice(position, 1);

        updateList(myPersons);
    }
}