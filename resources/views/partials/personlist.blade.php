<div class="js-personlist" data-field="{{$type}}" data-initial='{!! json_encode($initial ?? []) !!}'>
    <h3>{{$type}}s</h3>

    <div>
        <lable style="color: white;">EXISTING {{$type}}</lable>
        <select class="js-example-basic-single js-personlist-existing-person-chooser" name="state">
          @foreach ($choices as $choice)
            <option value="{{ $choice["id"] }}">{{ $choice["name"] }}</option>
          @endforeach
        </select>
        <button class="button secondary js-personlist-existing-person-add">Add</button>
    </div>

    <div>
        <lable style="color: white;">NEW {{$type}}</lable>
        <input type="text" name="humhum" class="js-personlist-new-person-field">
        <button class="button secondary js-personlist-new-person-add">Add</button>
    </div>

    <div>
      <ul class="js-personlist-choices">
      </ul>
    </div>
</div>
