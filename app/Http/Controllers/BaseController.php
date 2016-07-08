<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseFoundation\FlashMessages;
use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    use FlashMessages;

    protected $adminCpAccess;

    protected $loggedInUser = null;

    protected $CMSSettings;

    protected $defaultLanguageId, $defaultLanguage, $currentLanguage, $currentLanguageId, $currentLanguageCode;

    protected $loggedInAdminUser, $loggedInAdminUserRole = null;

    protected $activatedLanguages;

    protected function __construct()
    {
        $this->adminCpAccess = \Config::get('app.adminCpAccess');
        view()->share('adminCpAccess', $this->adminCpAccess);
        $this->CMSSettings = Models\Setting::getAllSettings();
        view()->share('CMSSettings', $this->CMSSettings);

        $this->defaultLanguageId = ($this->_getSetting('default_language')) ? (int) $this->_getSetting('default_language') : 59;
        $this->defaultLanguage = Models\Language::find($this->defaultLanguageId);
        $this->currentLanguage = Models\Language::getLanguageByLocale(app()->getLocale());
        if ($this->currentLanguage) {
            $this->currentLanguageId = $this->currentLanguage->id;
            $this->currentLanguageCode = $this->currentLanguage->language_code;
        } else {
            $this->currentLanguage = $this->defaultLanguage;
            $this->currentLanguageId = $this->currentLanguage->id;
            $this->currentLanguageCode = $this->currentLanguage->language_code;
        }
        view()->share([
            'defaultLanguage' => $this->defaultLanguage,
            'defaultLanguageId' => $this->defaultLanguageId,
            'currentLanguage' => $this->currentLanguage,
            'currentLanguageId' => $this->currentLanguageId,
            'currentLanguageCode' => $this->currentLanguageCode,
        ]);

        $this->_getAllActivatedLanguage();

        /*Get logged in user*/
        if (auth()->user()) {
            $this->loggedInUser = auth()->user();
        }
        view()->share('loggedInUser', $this->loggedInUser);

        /*Get logged in admin user*/
        $this->loggedInAdminUser = $this->_getLoggedInAdminUser(new Models\AdminUser());
        view()->share(['loggedInAdminUser' => $this->loggedInAdminUser]);
        if ($this->loggedInAdminUser) {
            $this->loggedInAdminUserRole = $this->loggedInAdminUser->adminUserRole;
            view()->share(['loggedInAdminUserRole' => $this->loggedInAdminUserRole]);
        }

        $this->_getHeaderAdminBarInFrontend();
    }

    protected function _getAllActivatedLanguage()
    {
        $activatedLanguages = Models\Language::getAllLanguages(1);
        $this->activatedLanguages = $activatedLanguages;
        view()->share(['activatedLanguages' => $this->activatedLanguages]);
    }

    protected function _viewAdmin($view, $data = [])
    {
        return view('admin.' . $view, $data);
    }

    protected function _viewFront($view, $data = [])
    {
        return view('front.' . $view, $data);
    }

    protected function _viewVendor($view, $data = [])
    {
        return view('vendor.' . $view, $data);
    }

    protected function _showErrorPage($errorCode = 404, $message = null)
    {
        $dis['message'] = $message;
        return response()->view('errors.' . $errorCode, $dis, $errorCode);
    }

    protected function _unsetLoggedInAdminUser(Models\AdminUser $adminUser)
    {
        auth()->guard($adminUser->getGuard())->logout();
    }

    protected function _getLoggedInAdminUser(Models\AdminUser $adminUser)
    {
        return auth()->guard($adminUser->getGuard())->user();
    }

    protected function _getSetting($key, $default = null)
    {
        if (isset($this->CMSSettings[$key])) {
            return $this->CMSSettings[$key];
        }

        return $default;
    }

    protected function _setBodyClass($class)
    {
        view()->share([
            'bodyClass' => $class,
        ]);
    }

    protected function _getHeaderAdminBarInFrontend()
    {
        $showHeaderAdminBar = false;
        $setting = (int) $this->_getSetting('show_admin_bar');
        if ($this->_getLoggedInAdminUser(new Models\AdminUser()) && $setting == 1) {
            $showHeaderAdminBar = true;
        }
        view()->share([
            'showHeaderAdminBar' => $showHeaderAdminBar,
        ]);
    }

    protected function _showConstructionMode()
    {
        if ((int) $this->_getSetting('construction_mode') == 1 && !$this->loggedInAdminUser) {
            return true;
        }

        return false;
    }

    protected function _sendFeedbackEmail($view, $subject, $data, $cc = [], $bcc = [])
    {
        return _sendEmail($view, $subject, $data, [
            [
                'name' => $this->_getSetting('site_title'),
                'email' => $this->_getSetting('email_receives_feedback'),
            ],
        ], $cc, $bcc);
    }

    protected function _getHomepageLink()
    {
        $page = Models\Page::getById($this->_getSetting('default_homepage'), $this->currentLanguageId);
        if ($page) {
            return asset($this->currentLanguageCode . '/' . $page->slug);
        }

        return asset($this->currentLanguageCode);
    }

    protected function _responseJson($error = true, $responseCode = 500, $message = [], $data = null)
    {
        return response()->json([
            'error' => $error,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function _responseRedirect($message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        $this->_setFlashMessage($message, $type);
        $this->_showFlashMessages();
        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    protected function _responseAutoDetect(Request $request, $message, $error = false, $responseCode = 500, $type = 'info', $withOldInputWhenError = false, $data = null)
    {
        if ($request->ajax()) {
            return $this->_responseJson($error, $responseCode, $message, $data);
        }

        return $this->_responseRedirect($message, $type, $error, $withOldInputWhenError);
    }
}
