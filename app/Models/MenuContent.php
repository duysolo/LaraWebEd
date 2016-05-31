<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;

class MenuContent extends AbstractModel
{
    protected $editableFields = [
        'menu_id',
        'language_id',
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
    protected $table = 'menu_contents';

    protected $primaryKey = 'id';

    /**
     * Validation
     */
    public $rules = array(
        'menu_id' => 'int',
        'language_id' => 'int',
    );

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id');
    }

    public function menuNode()
    {
        return $this->hasMany('App\Models\MenuNode', 'menu_content_id');
    }
}
