<div class="meta-box select-box" data-slug="{{ $fieldItem->slug or '' }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-select-wrap">
        <select class="form-control" data-fieldtype="{{ $fieldItem->field_type or '' }}"
                data-slug="{{ $fieldItem->slug or '' }}">
            <option value=""></option>
            @foreach(_getChoices($options->selectchoices) as $key => $row)
                <option value="{{ $row[0] or '' }}" {{ $row[0] == $theMeta ? 'selected="selected"' : '' }}>{{ $row[1] or '' }}</option>
            @endforeach
        </select>
    </div>
</div>