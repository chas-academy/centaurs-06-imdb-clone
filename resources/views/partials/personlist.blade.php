<div class="js-personlist personlist" data-field="{{$type}}" data-initial='{!! json_encode($initial ?? []) !!}'>
    <div class="personlist-existing-person-wrapper foundation-bottom-margin-half">
        <select class="js-example-basic-single js-personlist-existing-person-chooser person{{$type}} personlist-old-person-field" name="state">
            <option></option>
            @foreach ($choices as $choice)
                <option value="{{ $choice["id"] }}">{{ $choice["name"] }}</option>
            @endforeach
        </select>
        <button class="js-personlist-existing-person-add"><i class="fa fa-plus-circle fa-2x personlist-add-icon" aria-hidden="true"></i></button>
    </div>

    <div id="add-person" class="personlist-add-wrapper">
        <input type="text" name="text" placeholder="Add a new {{$type}}" class="js-personlist-new-person-field personlist-new-person-field inputfield-grey-placeholder">
        <button class="js-personlist-new-person-add personlist-add-button"><i class="fa fa-plus-circle fa-2x personlist-add-icon" aria-hidden="true"></i></button>
    </div>

    <div class="list-choices">
        <ul class="js-personlist-choices personlist-choices"></ul>
    </div>
</div>
