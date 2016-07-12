<?php
$selected = json_decode($theMeta);

if(!$selected) {
    $selected = [];
}
if (!$selected) {
    $selected = [];
    $selected[] = json_decode($options->defaultvalue);
}
$theMeta = $selected;
?>
<div class="scf-checkbox-wrap">
    @foreach(_getChoices($options->selectchoices) as $key => $row)
        <div class="dis-block">
            <label>
                <input type="checkbox"
                       data-fieldtype="{{ $fieldItem->field_type_updated or '' }}"
                       data-slug="{{ $fieldItem->slug or '' }}"
                       value="{{ $row[0] or '' }}" {{ in_array($row[0], $theMeta) ? 'checked="checked"' : '' }}>{{ $row[1] or '' }}
            </label>
        </div>
    @endforeach
</div>