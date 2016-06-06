<?php

if (! function_exists('_getSettings')) {
    function _getSettings($settings, $key)
    {
        if (isset($settings[$key]) && $settings[$key]) {
            return $settings[$key];
        }

        return null;
    }
}