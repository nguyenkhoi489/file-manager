<?php

namespace NguyenKhoi\FileManager\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileServices
{
    protected $folderService;
    protected $disk;
    protected $path;
    public function __construct(
        public FolderServices $folderServices
    )
    {
        $this->folderService = $this->folderServices;

        $this->disk = Storage::build([
            'driver' => file_manager_setting('default_disk', 'local'),
            'root' => public_path(\config('file-manager.path_folder')),
        ]);
    }

    public function find($path): bool
    {
        return $this->disk->exists($path);
    }

    public function renameItem($item,$name,$path_folder): array
    {
        $isExits = $this->disk->exists($item->permalink);

        if (! $isExits)
        {
            return [
                'success' => false,
                'message' => 'File Not found'
            ];
        }
        $file = File::extension($item->permalink);

        $this->disk->move($item->permalink, $path_folder . '/'. Str::slug($name) . '.' .$file);

        return [
            'success' => true,
            'message' => "The $name has been updated",
            'path' =>  $path_folder. '/'. Str::slug($name) . '.' .$file,
            'alt' => $name
        ];
    }

    public function uploadByURL($url, $folder_path = ''): array
    {
        $dir = $this->folderServices->getPath();
        if ($folder_path) {
            $isDir = $this->folderServices->findDir($folder_path);
            if ($isDir) {
                $dir = $folder_path;
            }
        }

        $allURL = $this->parseURL($url);

        if (! count($allURL)) return [
            'success' => false,
            'message' => 'File not found'
        ];

        $allUploaded = [];
        foreach ($allURL as $file) {
            $uploaded = $this->parseImageByURL($file,$folder_path);

            if ($uploaded) {
                $allUploaded[] = $uploaded;
            }
        }

        return $allUploaded;

    }
    protected function parseURL($url): array
    {
        if (!$url) return [];
        return explode("\r\n", $url);
    }

    protected function parseImageByURL($url,$folder): array
    {
        if (!$url) return [];

        $fileContent = file_get_contents($url);

        $filePath = pathinfo($url);

        $mimetype = null;

        foreach ($http_response_header as $v) {
            if (preg_match('/^content\-type:\s*(image\/[^;\s\n\r]+)/i', $v, $m)) {
                $mimetype = $m[1];
            }
        }

        if (! $mimetype) return [];

        if (! in_array($mimetype, config('file-manager.mime_types'))) return [];

        $dirFolder = $this->folderServices->getPath() ;

        if ($folder) {
            $dirFolder = $folder;
        }
        $fileName = $dirFolder . "/" . $filePath['basename'];

        $fileChecked = $this->disk->exists($fileName);

        if ($fileChecked) {
            $fileName = $dirFolder . "/" . time() . "_". $filePath['basename'];
        }
        $isFile = $this->disk->put($fileName, $fileContent);

        if ($isFile) {
            return [
                'success' => true,
                'message' => "The file '$url' has been created",
                'data' => [
                    'name' => $filePath['filename'],
                    'alt' => $filePath['filename'],
                    'permalink' => $fileName,
                    'mine_type' => $mimetype,
                    'size' => $this->disk->size($fileName),
                ]
            ];
        }
        return [
            'success' => true,
            'message' => "The file '$url' could not be created"
        ];
    }

}
