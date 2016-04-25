<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class MenuNode extends AbstractModel
{
    protected $editableFields = [
        'parent_id',
        'related_id',
        'url',
        'icon_font',
        'position',
        'title',
        'css_class',
        'parent_id'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_nodes';

    protected $primaryKey = 'id';

    /**
     * Validation
     */
    public $rules = array(
        'slug' => 'required|unique:menus',
    );

    public function menuNode()
    {
        return $this->hasMany('App\Models\MenuNode', 'menu_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuNode', 'parent_id');
    }

    public function child()
    {
        return $this->hasMany('App\Models\MenuNode', 'parent_id');
    }

    /**
     * Set the relationship
     *
     * @var children of post
     */
    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'related_id');
    }

    /**
     * Set the relationship
     *
     * @var children of post
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'related_id');
    }

    /**
     * Set the relationship
     *
     * @var children of post
     */
    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'related_id');
    }
}