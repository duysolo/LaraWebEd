<div class="meta-box textarea-box" data-slug="{{ $field_item->slug or '' }}">
    <p>
        <label class="sbold">{{ $field_item->title or '' }}</label><br>
        <span class="font-size-13">{{ $field_item->instructions or '' }}</span>
    </p>
    <div class="scf-textarea-wrap">
        <textarea rows="3" data-fieldtype="{{ $field_item->field_type or '' }}"
                  data-slug="{{ $field_item->slug or '' }}" placeholder="{{ $options->placeholdertext or '' }}"
                  class="form-control">{{ $the_meta or '' }}</textarea>
    </div>
</div>