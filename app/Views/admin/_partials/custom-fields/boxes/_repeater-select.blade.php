<div class="scf-select-wrap">
    <select class="form-control" data-fieldtype="{{ $fieldItem->field_type_updated or '' }}"
            data-slug="{{ $fieldItem->slug or '' }}">
        <option value=""></option>
        @foreach(_getChoices($options->selectchoices) as $key => $row)
            <option value="{{ $row[0] or '' }}" {{ $row[0] == $theMeta ? 'selected="selected"' : '' }}>{{ $row[1] or '' }}</option>
        @endforeach
    </select>
</div>