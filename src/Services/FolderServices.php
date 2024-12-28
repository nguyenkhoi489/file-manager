<?php

namespace NguyenKhoi\FileManager\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use NguyenKhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;
use NguyenKhoi\FileManager\Services\Trait\DiskServices;

class FolderServices extends BaseServices
{

    protected $path;
    protected  $disk;
    protected $fileRepository;

    public function __construct(
        public MediaFileRepositoryInterface $fileRepo
    )
    {
        parent::__construct();
        $this->disk = $this->getDisk();
        $this->fileRepository = $fileRepo;
    }

    public function getPath()
    {
        return '';
    }

    public function find($path): bool
    {
        return $this->disk->exists($path);
    }

    public function findDir($dirPath): bool
    {
        return $this->checkDirExist($dirPath);
    }

    protected function setDirPath($name): string
    {
        return Str::slug($name, '-');
    }

    protected function checkDirExist($path): bool
    {
        return $this->disk->exists($path);
    }

    public function renameItem($item, $new_name, $parent_path): array
    {
        $dirPath = $item->permalink;

        $created_new = $this->createDir($new_name, $parent_path);

        if (!$created_new['success']) {
            return $created_new;
        }

        $allFiles = $this->disk->files($dirPath);

        foreach ($allFiles as $file) {

            $this->disk->move($file, $created_new['path'] . '/' . basename($file));
            $this->fileRepository->updateFileByPermalink($file, [
                'permalink' => '/' .$created_new['path'] . '/' . basename($file)
            ]);

        }


        $removeDir = $this->disk->deleteDirectory($dirPath);

        if ($removeDir) {
            return $created_new;
        }
        return [
            'success' => false,
            'message' => 'Failed to remove directory'
        ];
    }

    public function createDir($name, $path = null): array
    {
        $dirPath = $this->setDirPath($name);
        if ($path) {
            $dirPath =  $path . "/" . Str::slug($name, '-');
        }
        $isExits = $this->checkDirExist($dirPath);

        if ($isExits) {
            return [
                'success' => false,
                'message' => "The folder $name already exist"
            ];
        }
        

        $createDirResult = $this->disk->makeDirectory($dirPath);

        if ($createDirResult) {

            File::chmod('uploads/'. $dirPath, config('file-manager.permission'));

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
