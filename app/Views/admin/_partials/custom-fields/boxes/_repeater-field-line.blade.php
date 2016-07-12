<li data-position="{{ $key or '' }}">
    <div class="col-xs-3">
        <span class="field-label">{{ $repeaterField[$currentRepeaterKey]->title or '' }}</span>
        <br>
        <span class="field-instructions">{{ $repeaterField[$currentRepeaterKey]->instructions or '' }}</span>
    </div>
    <div class="col-xs-9">
        {!! $object->initRepeaterInputItem($subField, $options, $current) !!}
    </div>
    <div class="clearfix"></div>
</li>