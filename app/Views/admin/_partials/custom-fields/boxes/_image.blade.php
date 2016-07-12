<?php
$imgSrc = $theMeta;
if (!trim((string)$imgSrc)) {
    $imgSrc = '/admin/images/no-image.png';
}
?>
<div class="meta-box normal-box" data-slug="{{ $fieldItem->slug or '' }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-image-wrap">
        <div class="select-media-box">
            <a title="" class="btn blue show-add-media-popup">Choose image</a>
            <div class="clearfix"></div>
            <a title="" class="show-add-media-popup"><img src="{{ $imgSrc or '' }}" alt="" class="img-responsive"></a>
            <input type="hidden" data-slug="{{ $fieldItem->slug or '' }}" data-fieldtype="{{ $fieldItem->field_type or '' }}" value="{{ $theMeta or '' }}" class="input-file">
            <a href="#" title="" class="remove-image"><span>&nbsp;</span></a>
        </div>
    </div>
</div>