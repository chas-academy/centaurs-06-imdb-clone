<div class="js-personlist" data-field="{{$personType}}">
    <h3 style="color: white;">{{$personType}}s</h3>

    <div>
        <lable style="color: white;">EXISTING {{$personType}}</lable>
        <select class="js-example-basic-single js-personlist-existing-person-chooser" name="state">
          @foreach ($persons as $person)
            <option value="{{ $person["id"] }}">{{ $person["name"] }}</option>
          @endforeach
        </select>
        <button class="button secondary js-personlist-existing-person-add">Add</button>
    </div>

    <div>
        <lable style="color: white;">NEW {{$personType}}</lable>
        <input type="text" name="humhum" class="js-personlist-new-person-field">
        <button class="button secondary js-personlist-new-person-add">Add</button>
    </div>

    <div>
      <ul class="js-personlist-choices">
      </ul>
    </div>
</div>