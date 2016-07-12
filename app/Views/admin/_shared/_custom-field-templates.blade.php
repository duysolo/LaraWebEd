<script id="_repeater_template" type="text/x-custom-template">
    <li data-position="___keyIndex___" class="ui-sortable-handle">
        <a href="#" class="remove-field-line" title="Remove this line"><span>&nbsp;</span></a>
        <a href="#" class="collapse-field-line" title="Colapse this line"><i class="fa fa-bars"></i></a>
        <div class="col-xs-12 clearfix">
            <ul class="sortable-wrapper disable-sortable" data-type="">___repeaterFieldLine___</ul>
        </div>
        <div class="clearfix"></div>
    </li>
</script>

<script id="_repeater-field-line_template" type="text/x-custom-template">
    <li data-position="___key___">
        <div class="col-xs-3">
            <span class="field-label">___title___</span>
            <br>
            <span class="field-instructions">___instructions___</span>
        </div>
        <div class="col-xs-9">___repeaterInputItem___</div>
        <div class="clearfix"></div>
    </li>
</script>

<script id="_repeater-text_template" type="text/x-custom-template">
    <div class="scf-text-wrap">
        <input type="text" data-fieldtype="___fieldType___" data-slug="___slug___"
               value="___value___" placeholder="___placeholder___" class="form-control">
    </div>
</script>

<script id="_repeater-number_template" type="text/x-custom-template">
    <div class="scf-text-wrap">
        <input type="number" data-fieldtype="___fieldType___" data-slug="___slug___"
               value="___value___" placeholder="___placeholder___" class="form-control">
    </div>
</script>

<script id="_repeater-email_template" type="text/x-custom-template">
    <div class="scf-text-wrap">
        <input type="email" data-fieldtype="___fieldType___" data-slug="___slug___"
               value="___value___" placeholder="___placeholder___" class="form-control">
    </div>
</script>

<script id="_repeater-password_template" type="text/x-custom-template">
    <div class="scf-text-wrap">
        <input type="password" data-fieldtype="___fieldType___" data-slug="___slug___"
               value="___value___" placeholder="___placeholder___" class="form-control">
    </div>
</script>

<script id="_repeater-textarea_template" type="text/x-custom-template">
    <div class="scf-textarea-wrap">
        <textarea rows="3"
                  data-fieldtype="___fieldType___"
                  data-slug="___slug___"
                  placeholder="___placeholder___"
                  class="form-control">___value___</textarea>
    </div>
</script>

<script id="_repeater-image_template" type="text/x-custom-template">
    <div class="scf-image-wrap">
        <div class="select-media-box">
            <a title="" class="btn blue show-add-media-popup">Choose image</a>
            <div class="clearfix"></div>
            <a title="" class="show-add-media-popup"><img src="/admin/images/no-image.png" alt="" class="img-responsive"></a>
            <input type="hidden" data-slug="___slug___"
                   data-fieldtype="___fieldType___" value=""
                   class="input-file">
            <a href="#" title="" class="remove-image"><span>&nbsp;</span></a>
        </div>
    </div>
</script>

<script id="_repeater-file_template" type="text/x-custom-template">
    <div class="scf-file-wrap">
        <div class="select-media-box">
            <a title="" class="btn blue show-add-media-popup">Choose file</a>
            <div class="clearfix"></div>
            <a title="" class="show-add-media-popup">
                <img src="/admin/images/no-image.png" alt="" class="img-responsive">
                <span class="title"></span>
            </a>
            <input type="hidden" data-slug="___slug___"
                   data-fieldtype="___fieldType___" value=""
                   class="input-file">
            <a href="#" title="" class="remove-image"><span>&nbsp;</span></a>
        </div>
    </div>
</script>

<script id="_repeater-select_template" type="text/x-custom-template">
    <div class="scf-select-wrap">
        <select class="form-control" data-fieldtype="___fieldType___" data-slug="___slug___">___choices___</select>
    </div>
</script>

<script id="_repeater-select-choices_template" type="text/x-custom-template">
    <option value="___value___" ___selected___>___title___</option>
</script>

<script id="_repeater-checkbox_template" type="text/x-custom-template">
    <div class="scf-checkbox-wrap">___choices___</div>
</script>

<script id="_repeater-checkbox-choices_template" type="text/x-custom-template">
    <div class="dis-block">
        <label>
            <input type="checkbox"
                   data-fieldtype="___fieldType___"
                   data-slug="___slug___"
                   value="___value___" ___selected___>___title___
        </label>
    </div>
</script>

<script id="_repeater-radio_template" type="text/x-custom-template">
    <div class="scf-radio-wrap">___choices___</div>
</script>

<script id="_repeater-radio-choices_template" type="text/x-custom-template">
    <div class="dis-block">
        <div class="dis-block">
            <label>
                <input type="radio"
                       data-fieldtype="___fieldType___"
                       data-slug="___slug___"
                       name="js_custom_fields____name___"
                       value="___value___" ___selected___>___title___
            </label>
        </div>
    </div>
</script>

<script id="_repeater-wyswyg_template" type="text/x-custom-template">
    <div class="scf-wyswyg-wrap scf-textarea-wrap">
        <___script___>
            $(document).ready(function () {
                var js_wyswyg_editor_field____name___ = '___toolbarType___';
                var toolbar = {};
                if (js_wyswyg_editor_field____name___ == 'basic') {
                    toolbar = {
                        toolbar: [['mode', 'Source', 'Image', 'TextColor', 'BGColor', 'Styles', 'Format', 'Font', 'FontSize', 'CreateDiv', 'PageBreak', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']]
                    };
                }
                CKEDITOR.replace("js_wyswyg_editor_field____name___", toolbar);
            });
        </___scriptEnd___>
    <textarea rows="3" id="js_wyswyg_editor_field____name___"
              data-fieldtype="___fieldType___"
              data-slug="___slug___"
              class="form-control wyswyg-editor"></textarea>
    </div>
</script>