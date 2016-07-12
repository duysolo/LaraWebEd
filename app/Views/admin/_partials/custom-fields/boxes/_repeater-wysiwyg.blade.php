<div class="scf-wyswyg-wrap scf-textarea-wrap">
    <script>
        $(document).ready(function () {
            CKEDITOR.replace("wyswyg_editor_field_{{ $fieldItem->slug . $current }}", {
                @if($options->wyswygtoolbar == 'basic')
                    toolbar: [['mode', 'Source', 'Image', 'TextColor', 'BGColor', 'Styles', 'Format', 'Font', 'FontSize', 'CreateDiv', 'PageBreak', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']]
                @endif
            });
        });
    </script>
    <textarea rows="3" id="wyswyg_editor_field_{{ $fieldItem->slug . $current }}"
              data-fieldtype="{{ $fieldItem->field_type_updated or 'wyswyg' }}" data-slug="{{ $fieldItem->slug or '' }}"
              placeholder="" class="form-control wyswyg-editor">{!! $theMeta or '' !!}</textarea>
</div>