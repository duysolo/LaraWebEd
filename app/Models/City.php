<?php
namespace App\Models;

class City extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    protected $rules = [
        'city_name' => 'required|max:255',
        'latitude' => 'numeric',
        'longitude' => 'numeric',
    ];

    protected $editableFields = [
        'city_name',
        'latitude',
        'longitude',
    ];

    public static function getCitiesByCountryId($countryId)
    {
        return static::getBy([
            'country_id' => $countryId,
        ], [
            'city_name' => 'ASC',
        ], true);
    }
}
