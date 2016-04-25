<?php namespace App\Http\Controllers\Front;

use Acme;
use App\Models;
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
        $item = $object->getPostBySlug($slug, $this->currentLanguageId);

        if (!$item) return $this->_showErrorPage(404, 'Page not found');

        $this->_setCurrentEditLink('Edit this post', 'posts/edit/'.$item->post_id.'/'.$this->currentLanguageId);

        $this->_loadFrontMenu();
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->id);

        return $this->_showItem($item);
    }

    private function _showItem(Post $item)
    {
        $this->_setBodyClass($this->bodyClass.' post-default');
        return $this->_viewFront('post-templates.default', $this->dis);
    }
}