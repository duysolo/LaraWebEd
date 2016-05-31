@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.js-tags-editor').tagsinput({
                'tagClass': 'label label-default'
            });
            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                },
                rules: {
                    'email_receives_feedback': {
                        required: true,
                        email: true
                    },
                    'site_title': {
                        required: true,
                        minlength: 3
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                }
            });
        });
    </script>
@endsection

@section('content')
    <form accept-charset="utf-8" novalidate action="" method="POST" class="js-validate-form">
        {!! csrf_field() !!}
        <div class="portlet light form-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-pin"></i>
                    <span class="caption-subject sbold uppercase">{{ $pageTitle}}</span>
                </div>
                <div class="actions">
                    <!--div class="btn-group btn-group-devided">
                        <button type="submit" class="btn btn-circle green font-white btn-default btn-sm">
                            <i class="fa fa-check"></i> Update
                        </button>
                    </div-->
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-bordered">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Homepage</label>
                            <div class="col-md-7">
                                <select name="default_homepage" class="form-control">
                                    @foreach($pages as $key => $row)
                                        <option value="{{ $row->id }}" {{ (isset($settings['default_homepage']) && (int)$settings['default_homepage'] == $row->id) ? 'selected' : '' }}>{{ $row->global_title }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">Homepage of this website</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Site title</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['site_title'] or '' }}" name="site_title"/>
                                <span class="help-block">Title of website.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Site logo</label>
                            <div class="col-md-7">
                                <div class="select-media-box">
                                    <button type="button" class="btn blue show-add-media-popup">Choose image</button>
                                    <div class="clearfix"></div>
                                    <a title="" class="show-add-media-popup"><img src="{{ (isset($settings['site_logo']) && trim($settings['site_logo'] != '')) ? $settings['site_logo'] : '/admin/images/no-image.png' }}" alt="Thumbnail" class="img-responsive"></a>
                                    <input type="hidden" name="site_logo" value="{{ $settings['site_logo'] or '' }}" class="input-file">
                                    <a title="" class="remove-image"><span>&nbsp;</span></a>
                                </div>
                                <span class="help-block">Select logo for this site.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Site keywords</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control js-tags-editor" value="{{ $settings['site_keywords'] or '' }}" name="site_keywords"/>
                                <span class="help-block">Use for SEO.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Site description</label>
                            <div class="col-md-7">
                                <textarea name="site_description" class="form-control" rows="5">{{ $settings['site_description'] or '' }}</textarea>
                                <span class="help-block">Use for SEO.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email receives feedback from clients</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['email_receives_feedback'] or '' }}" name="email_receives_feedback"/>
                                <span class="help-block">Email receives feedback from clients</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Default language</label>
                            <div class="col-md-7">
                                <select name="default_language" class="form-control">
                                    @foreach($activatedLanguages as $key => $row)
                                        <option {{ (isset($settings['default_language']) && $row->id == (int)$settings['default_language']) ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->language_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">CMS default language</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Dashboard language</label>
                            <div class="col-md-7">
                                <select name="dashboard_language" class="form-control">
                                    @foreach($activatedLanguages as $key => $row)
                                        <option {{ (isset($settings['dashboard_language']) && $row->id == (int)$settings['dashboard_language']) ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->language_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">CMS default language in dashboard</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Google analytics code</label>
                            <div class="col-md-7">
                                <textarea name="google_analytics" class="form-control" rows="5">{{ $settings['google_analytics'] or '' }}</textarea>
                                <span class="help-block">Add google analytics for site</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Google captcha</label>
                            <div class="col-md-7">
                                <div class="mar-bot-15">
                                    <label>Site key</label>
                                    <input type="text" class="form-control" value="{{ $settings['google_captcha_site_key'] or '' }}" name="google_captcha_site_key"/>
                                </div>
                                <label>Secret key</label>
                                <input type="text" class="form-control" value="{{ $settings['google_captcha_secret_key'] or '' }}" name="google_captcha_secret_key"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Hot line</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['hot_line'] or '' }}" name="hot_line"/>
                                <span class="help-block">Hot line.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Facebook</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['facebook'] or '' }}" name="facebook"/>
                                <span class="help-block">Facebook fanpage.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Twitter</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['twitter'] or '' }}" name="twitter"/>
                                <span class="help-block">Twitter.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Youtube</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['youtube'] or '' }}" name="youtube"/>
                                <span class="help-block">Youtube chanel.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Instagram</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['instagram'] or '' }}" name="instagram"/>
                                <span class="help-block">Instagram.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Pinterest</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['pinterest'] or '' }}" name="pinterest"/>
                                <span class="help-block">Pinterest.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Github</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{ $settings['github'] or '' }}" name="github"/>
                                <span class="help-block">Github page.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Construction mode</label>
                            <div class="col-md-7">
                                <div class="md-checkbox">
                                    <input type="checkbox"
                                           value="1"
                                           id="construction_mode"
                                           name="construction_mode"
                                           {{ (isset($settings['construction_mode']) && (int)$settings['construction_mode'] == 1) ? 'checked' : '' }}
                                           class="md-radiobtn">
                                    <label for="construction_mode" style="margin-bottom: 0;">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> In construction mode
                                    </label>
                                </div>
                                <span class="help-block">Make the site is on construction mode.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Show admin bar</label>
                            <div class="col-md-7">
                                <div class="md-checkbox">
                                    <input type="checkbox"
                                           value="1"
                                           id="show_admin_bar"
                                           name="show_admin_bar"
                                           {{ (isset($settings['show_admin_bar']) && (int)$settings['show_admin_bar'] == 1) ? 'checked' : '' }}
                                           class="md-radiobtn">
                                    <label for="show_admin_bar" style="margin-bottom: 0;">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Show admin bar
                                    </label>
                                </div>
                                <span class="help-block">When admin logged in, still show admin bar in website.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FORM-->
            </div>
            <div class="text-right" style="padding: 15px;">
                <button type="submit" class="btn btn-circle green font-white btn-default">
                    <i class="fa fa-check"></i> Update
                </button>
            </div>
        </div>
    </form>
@endsection
