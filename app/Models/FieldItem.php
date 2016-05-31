<?php
namespace App\Models;

use App\Models\AbstractModel;

class FieldItem extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'field_items';

    public $timestamps = false;

    /**
     * Validation
     */
    public $rules = array(
        'title' => 'required',
    );

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Set the relationship
     * Return user id that've updated the menu
     *
     * @var string
     **/
    public function fieldGroup()
    {
        return $this->belongsTo('App\Models\FieldGroup', 'field_group_id');
    }
}
