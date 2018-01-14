<div class="js-personlist" data-field="{{$personType}}">
    <!--<h3 style="color: white;">{{$personType}}s</h3> -->

    <div>
        <lable style="color: white;">Existing {{$personType}}</lable>
    </div>
   
    <div>
        <label>
        <select multiple class="multi-select" id="add-cast" name="state">
          @foreach ($persons as $person)
            <option value="{{ $person["id"] }}">{{ $person["name"] }}</option>
          @endforeach
        </select>
        <!--<button class="button secondary js-personlist-existing-person-add">+</button> -->
        </label>
    </div>


    <div>
        <!-- <lable style="color: white;">New {{$personType}}</lable> -->
        <input type="text" name="humhum" class="js-personlist-new-person-field" placeholder="Add">
        <button class="button secondary js-personlist-new-person-add">+</button>
    </div>

    <div>
      <ul class="js-personlist-choices">
      </ul>
    </div>

</div>

