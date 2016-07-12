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
        <textarea class="form-control" rows="5">{{ $options->selectchoices or '' }}</textarea>
    </div>
    <div class="clearfix"></div>
</div>