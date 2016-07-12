<?php
$selected = json_decode($theMeta);
if(!$selected) {
    $selected = (array)$theMeta;
}
if (!$selected) {
    $selected = [];
    $selected[] = $options->defaultvalue;
}
$theMeta = $selected;
?>
<div class="meta-box check-box" data-slug="{{ $fieldItem->slug or '' }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-checkbox-wrap">
        @foreach(_getChoices($options->selectchoices) as $key => $row)
            <div class="dis-block">
                <label>
                    <input type="checkbox"
                           data-fieldtype="{{ $fieldItem->field_type or '' }}"
                           data-slug="{{ $fieldItem->slug or '' }}"
                           value="{{ $row[0] or '' }}" {{ in_array($row[0], $theMeta) ? 'checked="checked"' : '' }}>{{ $row[1] or '' }}
                </label>
            </div>
        @endforeach
    </div>
</div>