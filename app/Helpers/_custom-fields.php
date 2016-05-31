<?php

function _getField($fields, $key)
{
    if (is_array($fields) && isset($fields[$key])) {
        return $fields[$key];
    }

    return null;
}

function _getRepeaterField($rawField)
{
    if (!$rawField) {
        $rawField = '[]';
    }

    $meta = (array) json_decode($rawField);
    return $meta;
}

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
