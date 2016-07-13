<?php namespace App\Http\Controllers\Front;

use App\Models\Page;
use App\Models\PageMeta;
use Illuminate\Http\Request;

class PageController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'page';
    }

    public function index(Request $request, Page $object)
    {
        $item = $object->getById($this->_getSetting('default_homepage'), $this->currentLanguageId);
        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        return redirect()->to($this->currentLanguage->language_code . '/' . $item->slug);
    }

    public function _handle(Request $request, Page $object, PageMeta $objectMeta, $slug)
    {
        $item = $object->getBySlug($slug, $this->currentLanguageId);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this page', 'pages/edit/' . $item->id . '/' . $this->currentLanguageId);

        $this->_loadFrontMenu($item->id, 'page');
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->content_id);

        //dd($this->dis['currentObjectCustomFields']);

        return $this->_showItem($item);
    }

    private function _showItem(Page $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_page_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' page-default');
        return $this->_viewFront('page-templates.default', $this->dis);
    }

    /* Template Name: Homepage*/
    private function _page_Homepage(Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' page-homepage');

        return $this->_viewFront('page-templates.homepage', $this->dis);
    }

    /* Template Name: Contact Us*/
    private function _page_ContactUs(Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' page-contact');
        return $this->_viewFront('page-templates.contact-us', $this->dis);
    }
}
