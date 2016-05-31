<?php
namespace App\Models;

use App\Models\AbstractModel;

class FieldGroup extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'field_groups';

    public $timestamps = true;

    /**
     * Validation
     */
    protected $rules = [
        'title' => 'required|max:255',
        'status' => 'integer|required|between:0,1',
        'field_rules' => 'required|json',
    ];

    protected $editableFields = [
        'title',
        'field_rules',
        'position',
        'status',
    ];

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Set the relationship
     * One menu has many menu nodes
     *
     * @var string
     */
    public function fieldItem()
    {
        return $this->hasMany('App\Models\FieldItem', 'field_group_id');
    }

    /**
     * Set the relationship
     * Return user id that've updated the menu
     *
     * @var string
     **/
    public function user()
    {
        return $this->belongsTo('App\Models\AdminUser', 'admin_user_id');
    }

    public static function deleteFieldGroup($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The field group you have tried to edit not found';
            return $result;
        }

        $temp = FieldItem::where('field_group_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        /*Remove all related content*/
        if ($related != null) {
            if ($temp->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete related item completed!'];
            }
            if ($object->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                if (is_array($result['message'])) {
                    $result['message'][] = 'Delete item completed!';
                } else {
                    $result['message'] = ['Delete item completed!'];
                }
            }
        } else {
            if ($object->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete item completed!'];
            }
        }

        return $result;
    }
}
