<?php
/**
 * Created by PhpStorm.
 * User: Musty
 * Date: 1/23/18
 * Time: 4:40 PM
 */

return [
    'client' => env('ROADSOFT_CLIENT', ''),
    'roadzoft_theme' => env('ROADSOFT_THEME', 'blue'),
    'current_version' => env('ROADSOFT_VERSION', '1.0.0'),
    'pdms' => env('ENABLE_PDMS', true),
    'module_project' => env('MODULE_PROJECT', false),
    'module_asset' => env('MODULE_ASSET', false),
    'module_people' => env('MODULE_PEOPLE', true),
];