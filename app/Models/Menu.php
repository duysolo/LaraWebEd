<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class Menu extends AbstractModel
{
    protected $editableFields = [
        'title',
        'slug',
        'status'
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
    protected $table = 'menus';

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

    public static function deleteMenu($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];
        $item = static::find($id);

        if (!$item) {
            $result['response_code'] = 404;
            $result['message'] = 'Menu not found';
            return $result;
        }

        $temp = $menuNodes = MenuNode::where('menu_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        /*Remove all related content*/
        if ($related != null) {
            if ($temp->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete related content completed!'];
            }
            if ($item->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete page completed!'];
            }
        } else {
            if ($item->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete page completed!'];
            }
        }

        return $result;
    }
}