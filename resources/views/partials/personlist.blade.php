<div class="js-personlist" data-field="{{$personType}}">

    <div>
    <select class="js-example-placeholder-multiple js-states form-control js-personlist-existing-person-chooser person{{$personType}}" multiple="multiple" name="state">
         @foreach ($persons as $person)
           <option value="{{ $person["id"] }}">{{ $person["name"] }}</option>
         @endforeach
       </select>
    </div>

    <div id="add-person">
    <input type="text" name="text" placeholder="Add a new {{$personType}}" class="js-personlist-new-person-field">
    <button id="person-btn" class="secondary js-personlist-new-person-add"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button>
    </div>

    <div>
      <ul class="js-personlist-choices">
      </ul>
    </div>

</div>
