<div class="js-personlist personlist" data-field="{{$type}}" data-initial='{!! json_encode($initial ?? []) !!}'>
    <div>
        <select class="js-example-placeholder-multiple js-states form-control js-personlist-existing-person-chooser person{{$type}}" multiple="multiple" name="state">
            @foreach ($choices as $choice)
                <option value="{{ $choice["id"] }}">{{ $choice["name"] }}</option>
            @endforeach
        </select>
    </div>

    <div id="add-person" class="personlist-add-wrapper">
        <input type="text" name="text" placeholder="Add a new {{$type}}" class="js-personlist-new-person-field personlist-new-person-field">
        <button class="js-personlist-new-person-add personlist-add-button"><i class="fa fa-plus-circle fa-2x personlist-add-icon" aria-hidden="true"></i></button>
    </div>

    <div class="list-choices">
        <ul class="js-personlist-choices personlist-choices"></ul>
    </div>
</div>
