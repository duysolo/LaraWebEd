<div class="scf-radio-wrap">
    @foreach(_getChoices($options->selectchoices) as $key => $row)
        <div class="dis-block">
            <label>
                <input type="radio"
                       data-fieldtype="{{ $fieldItem->field_type_updated or '' }}"
                       data-slug="{{ $fieldItem->slug or '' }}"
                       name="custom_fields_{{ $fieldItem->slug . $current }}"
                       value="{{ $row[0] or '' }}" {{ $row[0] == $theMeta ? 'checked="checked"' : '' }}>{{ $row[1] or '' }}
            </label>
        </div>
    @endforeach
</div>