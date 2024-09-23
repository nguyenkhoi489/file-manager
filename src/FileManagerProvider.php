<?php

namespace Nguyenkhoi\FileManager;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Nguyenkhoi\FileManager\Repositories\Files\MediaFileRepository;
use Nguyenkhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;
use Nguyenkhoi\FileManager\Repositories\Folders\MediaFolderRepository;
use Nguyenkhoi\FileManager\Repositories\Folders\MediaFolderRepositoryInterface;
use Nguyenkhoi\FileManager\Repositories\Settings\MediaSettingRepository;
use Nguyenkhoi\FileManager\Repositories\Settings\MediaSettingRepositoryInterface;

class FileManagerProvider extends ServiceProvider
{
    protected $files = [
        'file_manager_helper'
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->files as $file) {
            if (file_exists(__DIR__ . '/Helpers/' . $file . '.php')) {
                File::requireOnce(__DIR__ . '/Helpers/' . $file . '.php');
            }
        }

        $this->mergeConfigFrom(
            __DIR__ . '/Config/file-manager.php',
            'nkd-file-manager'
        );
        $this->app->bind(MediaSettingRepositoryInterface::class, MediaSettingRepository::class);
        $this->app->bind(MediaFileRepositoryInterface::class, MediaFileRepository::class);
        $this->app->bind(MediaFolderRepositoryInterface::class, MediaFolderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //Load migrations
        $this->publishes(array(
            __DIR__ . '/Database/migrations/' => database_path('migrations')
        ), 'nkd-file-manager-migrations');

        //Load Routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/filemanager.php');

        //Load assets
        $this->publishes([
            __DIR__
            . '/Resources/assets' => public_path('vendor/file-manager'),
        ], 'nkd-file-manager-assets');

        //Load Config
        $this->publishes([
            __DIR__
            . '/Config/file-manager.php' => config_path('file-manager.php'),
        ], 'nkd-file-manager-config');


        $this->loadViewsFrom(__DIR__ . '/Resources/views/', 'file-manager');
    }
}
