<?php

use App\Models\Setting;

/**
 * get Settings By Type
 *
 *
 * @return mixed
 */
function getSettingsByType($type)
{
    return \App\Models\Setting::where('type', $type)->get();
}