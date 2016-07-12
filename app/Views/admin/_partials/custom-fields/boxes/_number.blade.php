<div class="meta-box normal-box" data-slug="{{ $fieldItem->slug }}">
    <p>
        <label class="sbold">{{ $fieldItem->title or '' }}</label><br>
        <span class="font-size-13">{{ $fieldItem->instructions or '' }}</span>
    </p>
    <div class="scf-text-wrap">
        <input type="number" data-fieldtype="{{ $fieldItem->field_type or '' }}" data-slug="{{ $fieldItem->slug or '' }}"
               value="{{ $theMeta or '' }}" placeholder="{{ $options->placeholdertext or '' }}" class="form-control">
    </div>
</div>