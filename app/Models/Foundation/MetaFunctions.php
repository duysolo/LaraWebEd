<?php
namespace App\Models\Foundation;

use App\Models;

trait MetaFunctions
{
    public static function getContentMeta($content_id, $key)
    {
        $field = static::getBy([
            'content_id' => $content_id,
            'meta_key' => $key,
        ]);
        return ($field) ? $field->meta_value : null;
    }

    public static function getAllContentMeta($content_id)
    {
        $result = [];
        $fields = static::getBy([
            'content_id' => $content_id,
        ], null, true);
        foreach ($fields as $key => $row) {
            $result[$row->meta_key] = $row->meta_value;
        }
        return $result;
    }

    public static function checkContentMetaExists($content_id, $key)
    {
        $meta = static::getBy(['content_id' => $content_id, 'meta_key' => $key]);
        if (!$meta) {
            return false;
        }

        return true;
    }

    public static function saveContentMeta($content_id, $key, $value)
    {
        // If no value, delete the meta
        if (is_array($value)) {
            $value = json_encode($value);
        }

        if (trim($value) == '' || $value == '[]') {
            return static::deleteContentMeta($content_id, $key);
        }
        if (static::checkContentMetaExists($content_id, $key) != true) {
            $post_meta = new static();
            $post_meta->content_id = $content_id;
            $post_meta->meta_key = $key;
        } else {
            $post_meta = static::getBy([
                'content_id' => $content_id,
                'meta_key' => $key,
            ]);
        }
        $post_meta->meta_value = $value;
        return $post_meta->save();
    }

    public static function deleteContentMeta($content_id, $key)
    {
        $post_meta = static::getBy([
            'content_id' => $content_id,
            'meta_key' => $key,
        ]);
        if (!$post_meta) {
            return true;
        }

        return $post_meta->delete();
    }

    public static function deleteAllContentMeta($content_id)
    {
        $post_meta = static::getBy([
            'content_id' => $content_id,
        ]);
        if (!$post_meta) {
            return true;
        }

        return $post_meta->delete();
    }
}
