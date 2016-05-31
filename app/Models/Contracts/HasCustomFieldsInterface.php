<?php
namespace App\Models\Contracts;

interface HasCustomFieldsInterface
{
    public static function getContentMeta($content_id, $key);

    public static function getAllContentMeta($content_id);

    public static function checkContentMetaExists($content_id, $key);

    public static function saveContentMeta($content_id, $key, $value);

    public static function deleteContentMeta($content_id, $key);

    public static function deleteAllContentMeta($content_id);
}
