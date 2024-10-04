<?php
use NguyenKhoi\FileManager\Repositories\Settings\MediaSettingRepositoryInterface;

if (!function_exists('file_manager_setting')) {
    function file_manager_setting(string $setting = '', $default = 'local')
    {
        try {
            return app(MediaSettingRepositoryInterface::class)->getByKey($setting) ?? $default;
        } catch (\Exception $exception) {
            return $default;
        }
    }
}
