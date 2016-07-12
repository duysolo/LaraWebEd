<?php
$buttonLabel = $options->buttonlabel;
if ((trim($buttonLabel) == '')) {
    $buttonLabel = 'Add new';
}
$theMetaObject = json_decode($theMeta);
$repeaterItems = $object->_getRepeaterItems($fieldItem->field_group_id, $fieldItem->id);
?>
<div class="meta-box repeater-box" data-slug="{{ $fieldItem->slug or '' }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-repeater-wrap">
        <textarea class="scf-repeater-items form-control hidden" rows="10">{!! json_encode($repeaterItems) !!}</textarea>
        <ul class="sortable-wrapper" data-slug="{{ $fieldItem->slug }}">
            @if($theMetaObject) @foreach($theMetaObject as $key => $row)
                <?php
                    $keyIndex = $key + 1;
                ?>
                <li data-position="{{ $keyIndex }}">
                    <a href="#" class="remove-field-line" title="Remove this line"><span>&nbsp;</span></a>
                    <a href="#" class="collapse-field-line" title="Colapse this line"><i class="fa fa-bars"></i></a>
                    <div class="col-xs-12">
                        <ul class="sortable-wrapper disable-sortable" data-type="">
                            {!! $object->initRepeaterFieldLine($row, $repeaterItems, $keyIndex) !!}
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </li>
            @endforeach @endif
        </ul>
    </div>
    <div class="text-rig">
        <a href="#" class="repeater-add-new-field btn btn-success">{{ $buttonLabel or 'Add new' }}</a>
    </div>
</div>