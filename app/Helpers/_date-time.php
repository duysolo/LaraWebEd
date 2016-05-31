<?php

function _getTimestampOrDefault($timestamp, $default = null)
{
    if (!$default) {
        $default = date('Y-m-d H:i:s', time());
    }

    if ($timestamp == '0000-00-00 00:00:00') {
        return $default;
    }

    return $timestamp;
}
