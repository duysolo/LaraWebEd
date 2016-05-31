<?php namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\PostMeta;
use Illuminate\Http\Request;

class PostController extends BaseFrontController
{
    public function __construct()
    {
        $this->showSidebar = true;

        parent::__construct();
        $this->bodyClass = 'post';
    }

    public function _handle(Request $request, Post $object, PostMeta $objectMeta, $slug)
    {
        $item = $object->getBySlug($slug, $this->currentLanguageId);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this post', 'posts/edit/' . $item->post_id . '/' . $this->currentLanguageId);

        $this->_loadFrontMenu();
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->id);

        return $this->_showItem($item);
    }

    private function _showItem(Post $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_post_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Post $object)
    {
        $this->_setBodyClass($this->bodyClass . ' post-default');
        return $this->_viewFront('post-templates.default', $this->dis);
    }
}
