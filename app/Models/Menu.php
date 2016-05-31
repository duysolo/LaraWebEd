<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;

class Menu extends AbstractModel
{
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
        'status' => 'integer|required|between:0,1',
    );

    protected $editableFields = [
        'title',
        'slug',
        'status',
    ];

    public function menuContent()
    {
        return $this->hasMany('App\Models\MenuContent', 'menu_id');
    }

    public static function deleteMenu($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => [],
        ];
        $item = static::find($id);

        if (!$item) {
            $result['response_code'] = 404;
            $result['message'] = 'Menu not found';
            return $result;
        }

        $temp = MenuContent::where('menu_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        /*Remove all related content*/
        if ($related != null) {
            $menuContents = [];
            foreach ($related as $key => $row) {
                $menuContents[] = $row->id;
            }
            $tempMenuNode = MenuNode::whereIn('menu_content_id', $menuContents);
            if ($tempMenuNode->delete()) {
                $result['message'][] = 'Delete menu node completed!';
            } else {
                $result['message'][] = 'Some error occurred when delete related menu nodes!';
            }

            if ($temp->delete()) {
                $result['message'][] = 'Delete related content completed!';
            } else {
                $result['message'][] = 'Some error occurred when delete related menu content!';
            }
            if ($item->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'][] = 'Delete menu completed!';
            }
        } else {
            if ($item->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'][] = 'Delete menu completed!';
            }
        }

        return $result;
    }
}
