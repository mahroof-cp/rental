<?php

if (!function_exists('langKey')) {
    function langKey($key)
    {
        return (app()->getLocale() == 'ar') ? $key . '_ar' : $key . '_en';
    }
}