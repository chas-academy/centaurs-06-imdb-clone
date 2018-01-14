<div class="js-personlist" data-field="{{$personType}}" data-initial='{!! json_encode($initial ?? []) !!}'>
    <h3>{{$personType}}s</h3>

    <div>
        <lable style="color: white;">Existing {{$personType}}</lable>
    </div>
   
    <div>
        <label>
        <select name="state">
          @foreach ($persons as $person)
            <option value="{{ $person["id"] }}">{{ $person["name"] }}</option>
          @endforeach
        </select>
        <button class="button secondary js-personlist-existing-person-add">Add</button>
        </label>
    </div>

    <div>
        <lable style="color: white;">New {{$personType}}</lable>
        <input type="text" name="humhum" class="js-personlist-new-person-field">
        <button class="button secondary js-personlist-new-person-add">Add</button>
    </div>

    <div>
      <ul class="js-personlist-choices">
      </ul>
    </div>
</div>
