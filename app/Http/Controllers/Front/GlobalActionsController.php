<?php namespace App\Http\Controllers\Front;

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
        if (!_validateGoogleCaptcha($googleCaptchaResponse)) {
            return $this->_responseAutoDetect($request, trans('captcha.error'), true, 500, 'error', true);
        }

        $data = $request->all();
        if (isset($data['content'])) {
            $data['content'] = nl2br($data['content']);
        }
        $result = $object->fastEdit(_stripTags($data), true);
        $errorCode = ($result['error']) ? 500 : 200;
        $messageType = ($result['error']) ? 'error' : 'success';
        return $this->_responseAutoDetect($request, $result['message'], $result['error'], $errorCode, $messageType, true);
    }

    public function postSubscribeEmail(Request $request, Models\SubscribedEmails $object)
    {
        $result = $object->fastEdit(_stripTags($request->all()), true);
        $errorCode = ($result['error']) ? 500 : 200;
        $messageType = ($result['error']) ? 'error' : 'success';
        return $this->_responseAutoDetect($request, $result['message'], $result['error'], $errorCode, $messageType);
    }
}
