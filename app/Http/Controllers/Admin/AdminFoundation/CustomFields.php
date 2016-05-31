<?php namespace App\Http\Controllers\Admin\AdminFoundation;

trait CustomFields
{
    private function _saveContentMeta($contentId, $data, $object)
    {
        foreach ($data as $key => $row) {
            // is normal field => save text
            if (isset($row->field_value)) {
                $object->saveContentMeta($contentId, $row->field_slug, $row->field_value);
            } // Is repeater => save json
            else {
                $field_items = [];
                $field_slug = $row->field_slug;
                foreach ($row->field_items as $keyChild => $rowChild) {
                    array_push($field_items, $rowChild);
                }
                $object->saveContentMeta($contentId, $field_slug, json_encode($field_items));
            }
        }
    }
}
