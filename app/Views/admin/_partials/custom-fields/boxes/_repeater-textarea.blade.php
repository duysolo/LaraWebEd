<div class="scf-textarea-wrap">
    <textarea rows="3" data-fieldtype="{{ $fieldItem->field_type_updated or '' }}"
              data-slug="{{ $fieldItem->slug or '' }}" placeholder="{{ $options->placeholdertext or '' }}"
              class="form-control">{{ $theMeta or '' }}</textarea>
</div>