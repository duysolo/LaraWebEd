<?php
function _getSettings($settings, $key)
{
    if (isset($settings[$key]) && $settings[$key]) {
        return $settings[$key];
    }

    return null;
}
