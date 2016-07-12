<div class="meta-box textarea-box" data-slug="{{ $fieldItem->slug or '' }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-wyswyg-wrap scf-textarea-wrap">
        <script>
            $(document).ready(function () {
                CKEDITOR.replace("wyswyg_editor_field_{{ $fieldItem->slug . $fieldItem->id }}", {
                    @if($options->wyswygtoolbar == 'basic')
                        toolbar: [['mode', 'Source', 'Image', 'TextColor', 'BGColor', 'Styles', 'Format', 'Font', 'FontSize', 'CreateDiv', 'PageBreak', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']]
                    @endif
                });
            });
        </script>
            <textarea rows="3" name="wyswyg_editor_field_{{ $fieldItem->slug . $fieldItem->id }}" id="wyswyg_editor_field_{{ $fieldItem->slug . $fieldItem->id }}"
                      data-fieldtype="{{ $fieldItem->field_type or 'wyswyg' }}" data-slug="{{ $fieldItem->slug or '' }}"
                      class="form-control wyswyg-editor">{!! $theMeta or '' !!}</textarea>
    </div>
</div>