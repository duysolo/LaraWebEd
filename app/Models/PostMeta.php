<?php
namespace App\Models;

use App\Models\Contracts\HasCustomFieldsInterface;
use App\Models\Foundation\MetaFunctions;

class PostMeta extends AbstractModel implements HasCustomFieldsInterface
{
    use MetaFunctions;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_metas';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $editableFields = [
        'content_id',
        'meta_key',
        'meta_value',
    ];

    protected $rules = [
        'meta_key' => 'required|max:255',
    ];

    public function relatedContent()
    {
        return $this->belongsTo('App\Models\PostContent', 'content_id');
    }
}
