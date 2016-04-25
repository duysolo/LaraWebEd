<form action="/{{ $currentLanguageCode }}/global-actions/contact-us" method="POST" accept-charset="utf-8">
    {!! csrf_field() !!}
    <div class="form-group">
        <label>Subject</label>
        <input type="text" name="subject" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" autocomplete="off">
    </div>
    <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
        <div id="contactBoxCaptcha"></div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">Send request</button>
    </div>
</form>