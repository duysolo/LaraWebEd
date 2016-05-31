<?php
namespace App\Models;

class Contact extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'subject' => 'required|string',
        'name' => 'required|between:3,100',
        'phone' => 'numeric',
        'email' => 'required|email',
        'content' => 'string|required|between:30,5000',
        'status' => 'integer|between:0,1',
    ];

    protected $editableFields = [
        'subject',
        'name',
        'phone',
        'email',
        'content',
        'status',
    ];

    public static function deleteContact($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The contact you have tried to edit not found';
            return $result;
        }

        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete contact completed!'];
        }

        return $result;
    }
}
