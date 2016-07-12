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
                       name="radio_wyswygtoolbar_id_{{ $currentId or '' }}"
                       value="full" {{ (($options->wyswygtoolbar == 'full') ? ' checked="checked"' : '') }}
                       class="radio-wyswygtoolbar form-control">Full
            </label>
        </div>
        <div class="dis-block">
            <label>
                <input type="radio"
                       placeholder=""
                       name="radio_wyswygtoolbar_id_{{ $currentId or '' }}"
                       value="basic" {{ (($options->wyswygtoolbar == 'basic') ? ' checked="checked"' : '') }}
                       class="radio-wyswygtoolbar form-control">Basic
            </label>
        </div>
    </div>
    <div class="clearfix"></div>
</div>