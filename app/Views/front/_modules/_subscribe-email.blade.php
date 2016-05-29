<form class="form-inline" accept-charset="UTF-8" method="POST" action="{{ '/'.$currentLanguageCode.'/global-actions/subscribe-email' }}">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="subscribe-email">Hãy là người đầu tiên biết về các sự kiện của chúng tôi</label>
        <input type="text" class="form-control" id="subscribe-email" placeholder="Email" name="email" required>
    </div>
    <button type="submit" class="btn btn-default">Gửi</button>
</form>