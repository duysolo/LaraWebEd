<?php
namespace App\Models;

class SubscribedEmails extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscribed_emails';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'email' => 'required|email|unique:subscribed_emails',
    ];

    protected $editableFields = [
        'email',
    ];
}
