<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'app_scaffold_template' => env('APP_SCAFFOLD_TEMPLATE', 'email-login::layouts.scaffold'),
    'app_shell_template' => env('APP_SHELL_TEMPLATE', 'email-login::layouts.app_shell'),
    'app_assets_path' => env('APP_ASSETS_PATH', "assets"),
];
