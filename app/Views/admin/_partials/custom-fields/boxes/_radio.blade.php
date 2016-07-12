<div class="meta-box radio-box" data-slug="{{ $fieldItem->slug or '' }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-radio-wrap">
        @foreach(_getChoices($options->selectchoices) as $key => $row)
            <div class="dis-block">
                <label>
                    <input type="radio"
                           data-fieldtype="{{ $fieldItem->field_type or '' }}"
                           data-slug="{{ $fieldItem->slug or '' }}"
                           name="custom_fields_{{ $fieldItem->slug . $fieldItem->id }}"
                           value="{{ $row[0] or '' }}" {{ $row[0] == $theMeta ? 'checked="checked"' : '' }}>{{ $row[1] or '' }}
                </label>
            </div>
        @endforeach
    </div>
</div>