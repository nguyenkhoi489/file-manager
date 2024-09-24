<?php

namespace NguyenKhoi\FileManager\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FolderServices
{
    protected $path;
    private $disk;

    public function __construct()
    {
        $this->disk = Storage::disk(file_manager_setting('default_disk', 'public'));
        $this->path = config('file-manager.path_folder');
    }

    public function findDir($name): bool
    {
        $dirPath = $this->setDirPath($name);
        return $this->checkDirExist($dirPath);
    }

    protected function setDirPath($name): string
    {
        $name = Str::slug($name,'-');
        return $this->path . "/$name";
    }

    protected function checkDirExist($path): bool
    {
        return $this->disk->exists($path);
    }

    public function renameDir($old_name, $new_name): array
    {
        $dirPath = $this->setDirPath($old_name);

        $created_new = $this->createDir($new_name);

        if (! $created_new['success']) {
            return $created_new;
        }
        File::copyDirectory($dirPath, $created_new['path']);

        $removeDir = $this->disk->deleteDirectory($dirPath);

        if ($removeDir) {
            return $created_new;
        }
        return [
            'success' => false,
            'message' => 'Failed to remove directory'
        ];
    }

    public function createDir($name): array
    {
        $dirPath = $this->setDirPath($name);

        $isExits = $this->checkDirExist($dirPath);

        if ($isExits) {
            return [
                'success' => false,
                'message' => "The folder $name already exist"
            ];
        }

        $createDirResult = $this->disk->makeDirectory($dirPath);

        if ($createDirResult) {
            return [
                'success' => true,
                'message' => "The folder $name has been created",
                'path' => $dirPath
            ];
        }

        File::chmod($dirPath,config('file-manager.permission'));

        return [
            'success' => false,
            'message' => "The folder $name could not be created"
        ];
    }
}
