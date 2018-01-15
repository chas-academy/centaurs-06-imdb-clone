<div class="js-personlist" data-field="{{$personType}}">

   
    <div>
    <select class="js-example-placeholder-multiple js-states form-control js-personlist-existing-person-chooser {{$personType}}" multiple="multiple" name="state">
         @foreach ($persons as $person)
           <option value="{{ $person["id"] }}">{{ $person["name"] }}</option>
         @endforeach
       </select>
    </div>


    <div>
    <input type="text" name="humhum" placeholder="Add a new {{$personType}}" class="js-personlist-new-person-field">
        <button id="add-button" class="button secondary js-personlist-new-person-add">+</button>
    </div>

    <div>
      <ul class="js-personlist-choices">
      </ul>
    </div>

</div>
