<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\BaseTrait\FlashMessages;

use App\Models;

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

        $this->defaultLanguageId = ($this->_getSetting('default_language')) ? (int)$this->_getSetting('default_language') : 59;
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
        $this->loggedInAdminUser = $this->_getLoggedInAdminUser();
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

    protected function _setLoggedInAdminUser($user)
    {
        session(['adminAuthUser' => $user]);
    }

    protected function _unsetLoggedInAdminUser()
    {
        session(['adminAuthUser' => null]);
    }

    protected function _getLoggedInAdminUser()
    {
        return session('adminAuthUser', null);
    }

    protected function _getSetting($key, $default = null)
    {
        if (isset($this->CMSSettings[$key])) return $this->CMSSettings[$key];
        return $default;
    }

    protected function _setBodyClass($class)
    {
        view()->share([
            'bodyClass' => $class
        ]);
    }

    protected function _getHeaderAdminBarInFrontend()
    {
        $showHeaderAdminBar = false;
        $setting = (int)$this->_getSetting('show_admin_bar');
        if ($this->_getLoggedInAdminUser() && $setting == 1) {
            $showHeaderAdminBar = true;
        }
        view()->share([
            'showHeaderAdminBar' => $showHeaderAdminBar,
        ]);
    }

    protected function _showConstructionMode()
    {
        if ((int)$this->_getSetting('construction_mode') == 1 && !$this->loggedInAdminUser) return true;
        return false;
    }

    protected function _validateGoogleCaptcha($response)
    {
        return _validateGoogleCaptcha($this->_getSetting('google_captcha_secret_key'), $response);
    }

    protected function _stripTagsData($data, $allowTags = '<p><a><br><br/><b><strong>')
    {
        if (!is_array($data)) {
            return strip_tags($data, $allowTags);
        }
        foreach ($data as $key => $row) {
            $data[$key] = strip_tags($row, $allowTags);
        }
        return $data;
    }

    protected function _sendEmail($view, $data, $cc = [], $bcc = [])
    {
        return _sendEmail($view, $data, [
            [
                'name' => $this->_getSetting('site_title'),
                'email' => $this->_getSetting('email_receives_feedback'),
            ]
        ], $cc, $bcc);
    }

    protected function _getHomepageLink()
    {
        $page = Models\Page::getPageById($this->_getSetting('default_homepage'), $this->currentLanguageId);
        if($page) return asset($this->currentLanguageCode.'/'.$page->slug);
        return asset($this->currentLanguageCode);
    }
}