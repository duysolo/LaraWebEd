Page template
=============

This guide show you how to create a page template (for page, post, product, categories, product categories...)

----------

For page
--------

- Go to **app/Http/Controllers/Front/PageController.php**
- Create a comment line:

````code
/* Template Name: Contact Us*/
````

Then create a function with prefix **\_page\_** and that template name with no spacing.

````code
private function _page_ContactUs(Page $object)
{
    $this->_setBodyClass($this->bodyClass.' page-contact');
    return $this->_viewFront('page-templates.contact-us', $this->dis);
}
````

You can specify the view for this page template. The view templates of page should be placed at **app/Views/front/page-templates**.
Now, you can select the page template of page when create or edit a page.

For post, category, product, product category
---------------------------------------------

- Post: **app/Http/Controllers/Front/PostController.php** with prefix **\_post\_**
- Category: **app/Http/Controllers/Front/CategoryController.php** with prefix **\_category\_**
- Product: **app/Http/Controllers/Front/ProductController.php** with prefix **\_product\_**
- Product category: **app/Http/Controllers/Front/ProductCategoryController.php** with prefix **\_productCategory\_**