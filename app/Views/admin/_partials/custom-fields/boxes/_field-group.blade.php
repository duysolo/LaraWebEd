@foreach($fieldGroups as $key => $row)
    @if(is_array($rules) && $object->_checkRules($rules, $row))
        <div class="portlet light bordered meta-boxes">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-note font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">{{ $row->title or '' }}</span>
                </div>
                <div class="tools">
                    <a class="collapse" href="" data-original-title="" title=""></a>
                    <a class="fullscreen" href="" data-original-title="" title=""></a>
                </div>
            </div>
            <div class="portlet-body">
                <?php
                $fieldItems = $object->getGroupNodes($row->id, 0)
                ?>
                @foreach($fieldItems as $keyItem => $rowItem)
                    {!! $object->_getCustomFieldsBoxItems($rowItem, $contentId, $useFor) !!}
                @endforeach
            </div>
        </div>
    @endif
@endforeach