<div class="add-new-field">
    <ul class="list-group field-table-header">
        <li class="col-xs-4 list-group-item w-bold">Field Label</li>
        <li class="col-xs-4 list-group-item w-bold">Field Name</li>
        <li class="col-xs-4 list-group-item w-bold">Field Type</li>
        <li class="clearfix"></li>
    </ul>
    <div class="clearfix"></div>
    <ul class="sortable-wrapper mar-bot-10">
        @foreach($fieldItems as $key => $row)
            <li class="ui-sortable-handle"
                data-position="{{ $key + 1 }}"
                data-repeateritems=""
                data-options=""
                data-id="{{ $row->id or '' }}"
                data-name="{{ $row->slug or '' }}"
                data-title="{{ $row->title or '' }}"
                data-type="{{ $row->field_type or '' }}"
                data-instructions="{{ $row->instructions or '' }}">
                <div class="field-column">
                    <div class="text col-xs-4 field-label">{{ ((trim($row->title) != '') ? $row->title : '&nbsp;') }}</div>
                    <div class="text col-xs-4 field-name">{{ ((trim($row->slug) != '') ? $row->slug : '&nbsp;') }}</div>
                    <div class="text col-xs-4 field-type">{{ ((trim($row->field_type) != '') ? $row->field_type : '&nbsp;') }}</div>
                    <a class="show-item-details" title="" href="#"><i class="fa fa-angle-down"></i></a>
                    <div class="clearfix"></div>
                </div>
                <div class="item-details">
                    <div class="line" data-option="title">
                        <div class="col-xs-3">
                            <h5>Field Label</h5>
                            <p>This is the name which will appear on the EDIT page</p>
                        </div>
                        <div class="col-xs-9">
                            <h5>Field Label</h5>
                            <input type="text" class="form-control" placeholder="" value="{{ $row->title or '' }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="line" data-option="instructions">
                        <div class="col-xs-3">
                            <h5>Field Instructions</h5>
                            <p>Instructions for authors. Shown when submitting data</p>
                        </div>
                        <div class="col-xs-9">
                            <h5>Field Instructions</h5>
                            <input type="text" class="form-control" placeholder=""
                                   value="{{ $row->instructions or '' }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="line" data-option="name">
                        <div class="col-xs-3">
                            <h5>Field Name</h5>
                            <p>Single word, no spaces. Underscores and dashes allowed</p>
                        </div>
                        <div class="col-xs-9">
                            <h5>Field Name</h5>
                            <input type="text" class="form-control" placeholder="" value="{{ $row->slug or '' }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="line" data-option="type">
                        <div class="col-xs-3"><h5>Field Type</h5></div>
                        <div class="col-xs-9">
                            <h5>Field Type</h5>
                            <select name="" class="form-control change-field-type">
                                <optgroup label="Basic">
                                    <option value="text" {{ (($row->field_type == 'text') ? ' selected="selected"' : '') }}>
                                        Text
                                    </option>
                                    <option value="textarea" {{ (($row->field_type == 'textarea') ? ' selected="selected"' : '') }}>
                                        Textarea
                                    </option>
                                    <option value="number" {{ (($row->field_type == 'number') ? ' selected="selected"' : '') }}>
                                        Number
                                    </option>
                                    <option value="email" {{ (($row->field_type == 'email') ? ' selected="selected"' : '') }}>
                                        Email
                                    </option>
                                    <option value="password" {{ (($row->field_type == 'password') ? ' selected="selected"' : '') }}>
                                        Password
                                    </option>
                                </optgroup>
                                <optgroup label="Content">
                                    <option value="wyswyg" {{ (($row->field_type == 'wyswyg') ? ' selected="selected"' : '') }}>
                                        WYSIWYG editor
                                    </option>
                                    <option value="image" {{ (($row->field_type == 'image') ? ' selected="selected"' : '') }}>
                                        Image
                                    </option>
                                    <option value="file" {{ (($row->field_type == 'file') ? ' selected="selected"' : '') }}>
                                        File
                                    </option>
                                </optgroup>
                                <optgroup label="Choice">
                                    <option value="select" {{ (($row->field_type == 'select') ? ' selected="selected"' : '') }}>
                                        Select
                                    </option>
                                    <option value="checkbox" {{ (($row->field_type == 'checkbox') ? ' selected="selected"' : '') }}>
                                        Checkbox
                                    </option>
                                    <option value="radio" {{ (($row->field_type == 'radio') ? ' selected="selected"' : '') }}>
                                        Radio button
                                    </option>
                                </optgroup>
                                @if(isset($isRepeater) && !$isRepeater)
                                    <optgroup label="Other">
                                        <option value="repeater" {{ (($row->field_type == 'repeater') ? ' selected="selected"' : '') }}>
                                            Repeater
                                        </option>
                                    </optgroup>
                                @endif
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="options">
                        @if ($row->field_type == 'repeater')
                            <div class="line" data-option="repeater">
                                <div class="col-xs-3">
                                    <h5>Repeater fields</h5>
                                </div>
                                <div class="col-xs-9">
                                    <h5>Repeater fields</h5>
                                    @include('admin._partials.custom-fields._field-group-items', ['fieldItems' => $row->child()->orderBy('position', 'ASC')->get(), 'isRepeater' => true, 'object' => $object])
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                        {!! $object->_getOptionCustomFields($row->field_type, json_decode($row->options), $row->id) !!}
                    </div>
                    <div class="text-right pad-top-10 pad-bot-10 pad-rig-10">
                        <a class="btn red btn-remove" title="" href="#">Remove</a>
                        <a class="btn blue btn-close-field" title="" href="#">Close fields</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="text-right">
        <a class="btn red btn-add-field" title="" href="{{ (!$isRepeater) ? '#nestable > .dd-list' : 'repeater' }}"
           id="">Add field</a>
    </div>
</div>