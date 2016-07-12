<script id="_options-repeater_template" type="text/x-custom-template">
    <div class="line" data-option="repeater">
        <div class="col-xs-3">
            <h5>Repeater fields</h5>
        </div>
        <div class="col-xs-9">
            <h5>Repeater fields</h5>
            <div class="add-new-field">
                <ul class="list-group field-table-header">
                    <li class="col-xs-4 list-group-item w-bold">Field Label</li>
                    <li class="col-xs-4 list-group-item w-bold">Field Name</li>
                    <li class="col-xs-4 list-group-item w-bold">Field Type</li>
                    <li class="clearfix"></li>
                </ul>
                <div class="clearfix"></div>
                <ul class="sortable-wrapper mar-bot-10">

                </ul>
                <div class="text-right">
                    <a class="btn red btn-add-field" title="" href="repeater" id="">Add field</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_options-defaultvalue_template" type="text/x-custom-template">
    <div class="line" data-option="defaultvalue">
        <div class="col-xs-3">
            <h5>Default Value</h5>
            <p>Appears when creating a new post</p>
        </div>
        <div class="col-xs-9">
            <h5>Default Value</h5>
            <input type="text" class="form-control" placeholder="" value="">
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_options-placeholdertext_template" type="text/x-custom-template">
    <div class="line" data-option="placeholdertext">
        <div class="col-xs-3">
            <h5>Placeholder Text</h5>
            <p>Appears within the input</p>
        </div>
        <div class="col-xs-9">
            <h5>Placeholder Text</h5>
            <input type="text" class="form-control" placeholder="" value="">
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_options-defaultvaluetextarea_template" type="text/x-custom-template">
    <div class="line" data-option="defaultvaluetextarea">
        <div class="col-xs-3">
            <h5>Default Value</h5>
            <p>Appears when creating a new post</p>
        </div>
        <div class="col-xs-9">
            <h5>Default Value</h5>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_options-wyswygtoolbar_template" type="text/x-custom-template">
    <div class="line" data-option="wyswygtoolbar">
        <div class="col-xs-3">
            <h5>Toolbar</h5>
        </div>
        <div class="col-xs-9">
            <h5>Toolbar</h5>
            <div class="dis-block">
                <label>
                    <input type="radio"
                           placeholder=""
                           name="js_radio_wyswygtoolbar_id____name___"
                           value="full"
                           class="radio-wyswygtoolbar form-control">Full
                </label>
            </div>
            <div class="dis-block">
                <label>
                    <input type="radio"
                           placeholder=""
                           name="js_radio_wyswygtoolbar_id____name___"
                           value="basic" checked="checked"
                           class="radio-wyswygtoolbar form-control">Basic
                </label>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_options-selectchoices_template" type="text/x-custom-template">
    <div class="line" data-option="selectchoices">
        <div class="col-xs-3">
            <h5>Choices</h5>
            <p>Enter each choice on a new line.<br>
                For more control, you may specify both a value and label like this:<br>
                red: Red<br>
                blue: Blue
            </p>
        </div>
        <div class="col-xs-9">
            <h5>Choices</h5>
            <textarea class="form-control" rows="5"></textarea>
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_options-buttonlabel_template" type="text/x-custom-template">
    <div class="line" data-option="buttonlabel">
        <div class="col-xs-3">
            <h5>Button label</h5>
        </div>
        <div class="col-xs-9">
            <h5>Button label</h5>
            <input type="text" class="form-control" placeholder="" value="">
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script id="_new-field-source_template" type="text/x-custom-template">
    <li class="ui-sortable-handle active"
        data-position="0"
        data-repeateritems=""
        data-options=""
        data-id=""
        data-name=""
        data-title="New field"
        data-type="text"
        data-instructions="">
        <div class="field-column">
            <div class="text col-xs-4 field-label">New field</div>
            <div class="text col-xs-4 field-name"></div>
            <div class="text col-xs-4 field-type">text</div>
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
                    <input type="text" class="form-control" placeholder="" value="New field">
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
                    <input type="text" class="form-control" placeholder="" value="">
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
                    <input type="text" class="form-control" placeholder="" value="">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="line" data-option="type">
                <div class="col-xs-3"><h5>Field Type</h5></div>
                <div class="col-xs-9">
                    <h5>Field Type</h5>
                    <select name="" class="form-control change-field-type">
                        <optgroup label="Basic">
                            <option value="text" selected="selected">Text</option>
                            <option value="textarea">Textarea</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                        </optgroup>
                        <optgroup label="Content">
                            <option value="wyswyg">WYSIWYG editor</option>
                            <option value="image">Image</option>
                            <option value="file">File</option>
                        </optgroup>
                        <optgroup label="Choice">
                            <option value="select">Select</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio button</option>
                        </optgroup>
                        <optgroup label="Other"><option value="repeater">Repeater</option></optgroup>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="options">___options___</div>
            <div class="text-right pad-top-10 pad-bot-10 pad-rig-10">
                <a class="btn red btn-remove" title="" href="#">Remove</a>
                <a class="btn blue btn-close-field" title="" href="#">Close fields</a>
            </div>
        </div>
    </li>
</script>