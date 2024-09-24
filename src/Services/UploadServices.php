<?php

namespace NguyenKhoi\FileManager\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadServices
{
    private $disk;
    protected $path;
    public function __construct()
    {
        $this->disk = Storage::disk(file_manager_setting('default_disk','public'));
        $this->path =  config('file-manager.path_folder');
    }

    protected function setDirPath($name): string
    {
        $name = Str::slug($name);
        return $this->path . "/$name";
    }

    protected function checkDirExist($path): bool
    {
        return $this->disk->exists($path);
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
        };

        $createDirResult = $this->disk->makeDirectory($dirPath);

        if ($createDirResult) {
            return [
                'success' => true,
                'message' => "The folder $name has been created",
                'path' => $dirPath
            ];
        }
        return [
            'success' => false,
            'message' => "The folder $name could not be created"
        ];
    }
}
