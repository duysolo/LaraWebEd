<?php namespace App\Http\Controllers\Front;

use Acme;
use App\Models;
use Illuminate\Http\Request;

class GlobalActionsController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'product';
    }

    public function postContactUs(Request $request, Models\Contact $object)
    {
        $googleCaptchaResponse = $request->get('g-recaptcha-response', null);
        if (!$this->_validateGoogleCaptcha($googleCaptchaResponse)) {
            $this->_setFlashMessage(trans('captcha.error'), 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $data = $request->all();
        if(isset($data['content']))
        {
            $data['content'] = nl2br($data['content']);
        }
        $result = $object->fastEdit($this->_stripTagsData($data), true);
        if($result['error'])
        {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_setFlashMessage(trans('cms.requestNotCompleted'), 'error');
            $this->_showFlashMessages();
        }
        else
        {
            $this->_setFlashMessage(trans('cms.requestCompleted'), 'success');
            $this->_showFlashMessages();
        }

        /*Send email*/
        //$this->_sendEmail('front.emails.contact-us', $data);

        return redirect()->back();
    }
}