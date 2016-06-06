<?php

if (! function_exists('_getField')) {
    function _getField($fields, $key)
    {
        if (is_array($fields) && isset($fields[$key])) {
            return $fields[$key];
        }

        return null;
    }
}

if (! function_exists('_getRepeaterField')) {
    function _getRepeaterField($rawField)
    {
        if (!$rawField) {
            $rawField = '[]';
        }

        $meta = (array)json_decode($rawField);
        return $meta;
    }
}

if (! function_exists('_getSubField')) {
    function _getSubField($parentMeta, $key)
    {
        if (!is_array($parentMeta)) {
            $parentMeta = json_decode($parentMeta);
        }

        foreach ($parentMeta as $row) {
            if ($row->slug == $key) {
                return $row->field_value;
            }

        }
        return '';
    }
}