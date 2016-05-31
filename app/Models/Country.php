<?php
namespace App\Models;

class Country extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'country_name' => 'required|max:255',
        'status' => 'integer|required|between:0,1',
    ];

    protected $editableFields = [
        'country_name',
        'country_2_code',
        'country_3_code',
        'total_city',
        'status',
    ];

    public function city()
    {
        return $this->hasMany('App\Models\City', 'country_id');
    }
}
