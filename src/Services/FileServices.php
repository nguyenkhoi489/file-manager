<?php

namespace NguyenKhoi\FileManager\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FileServices extends BaseServices
{

    protected $folderService;
    protected $resizeService;
    protected $path;
    protected $disk;

    public function __construct(
        public FolderServices $folderServices,
        public ResizeImage    $resizeImage
    )
    {
        parent::__construct();
        $this->folderService = $this->folderServices;
        $this->resizeService = $resizeImage;
        $this->disk = $this->getDisk();
    }

    public function cropImage(string $file_path, string $crop_data): array
    {

        $file = $this->disk->exists($file_path);
        if (!$file) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_found")
            ];
        }
        $this->resizeService->setImageData(array_merge(['path' => $file_path], json_decode($crop_data, true)));

        return $this->resizeService->resize();
    }

    public function uploadMultipleFile($files, $folder): array
    {

        if (!is_array($files)) {
            return [$this->uploadFile($files, $folder)];
        }
        if (!count($files)) return [
            'success' => false,
            'message' => 'No files were uploaded.'
        ];

        if (count($files) > config('file-manager.limit_upload_files')) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_upload_limit")
            ];
        }
        $allFiles = [];

        foreach ($files as $file) {
            $allFiles[] = $this->uploadFile($file, $folder);
        }

        return $allFiles;
    }

    protected function uploadFile($file, $folder)
    {
        if (!$file) {
            return [
                'success' => false,
                'message' => 'No files were uploaded.'
            ];
        }
        if (!in_array($file->getClientMimeType(), config('file-manager.mime_types'))) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.can_not_detect_file_type")
            ];
        }
        if ($file->getSize() > config('file-manager.max_file_size')) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_too_big", [
                    'size' => config('file-manager.max_file_size')
                ])
            ];
        }
        $folder_path = $this->folderServices->getPath();

        if ($folder) {
            $folder_path = '/' . $folder->permalink;
        }
        $folder_path = $folder_path ? $folder_path : "";


        $fileName = $folder_path . '/' . $file->getClientOriginalName();

        if ($this->disk->exists($fileName)) {
            $fileName = $folder_path . '/' . time() . '_' . $file->getClientOriginalName();
        }

        $isUpload = $this->disk->put($fileName, $file->getContent());
        if ($isUpload) {
            $fileUploaded = $this->disk->path($fileName);
            return [
                'success' => true,
                'message' => "The file has been uploaded",
                'data' => [
                    'name' => File::name($fileUploaded),
                    'alt' => File::name($fileUploaded),
                    'permalink' => $fileName,
                    'mine_type' => File::mimeType($fileUploaded),
                    'size' => File::size($fileUploaded),
                ]
            ];
        }
        return [
            'success' => false,
            'message' => trans("file-manager::media.message.file_not_uploaded")
        ];
    }

    public function find($path): bool
    {
        return $this->disk->exists($path);
    }

    public function renameItem($item, $name, $path_folder): array
    {
        $isExits = $this->disk->exists($item->permalink);

        if (!$isExits) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_found")
            ];
        }
        $file = File::extension($item->permalink);

        $this->disk->move($item->permalink, $path_folder . '/' . Str::slug($name) . '.' . $file);

        return [
            'success' => true,
            'message' => trans("file-manager::media.message.file_not_found", [
                'name' => $name
            ]),
            'path' => $path_folder . '/' . Str::slug($name) . '.' . $file,
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

        if (!count($allURL)) return [
            'success' => false,
            'message' => trans("file-manager::media.message.file_not_found")
        ];

        $allUploaded = [];
        foreach ($allURL as $file) {
            $uploaded = $this->parseImageByURL($file, $dir);

            if (count($uploaded) > 0 && isset($uploaded['data'])) {
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

    protected function parseImageByURL($url, $folder): array
    {
        if (!$url) return [];
        $fileContent = Http::withoutVerifying()->timeout(10)->get($url);

        if (!$fileContent->successful()) {
            return [
                'success' => true,
                'message' => trans("file-manager::media.message.file_url_cannot_upload_with_error", [
                    'url' => $url,
                    'error' => error_get_last()
                ])
            ];
        }
        $filePath = pathinfo($url);

        $mimetype = $fileContent->header('Content-type');

        if (!$mimetype) return [];

        if (!in_array($mimetype, config('file-manager.mime_types'))) return [];

        $dirFolder = $this->folderServices->getPath();

        if ($folder) {
            $dirFolder = $folder;
        }
        $fileName = $dirFolder . "/" . $filePath['basename'];

        $fileChecked = $this->disk->exists($fileName);

        if ($fileChecked) {
            $fileName = $dirFolder . "/" . time() . "_" . $filePath['basename'];
        }
        $isFile = $this->disk->put($fileName, $fileContent->body());

        if ($isFile) {
            return [
                'success' => true,
                'message' => trans("file-manager::media.message.file_url_uploaded", [
                    'url' => $url
                ]),
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
            'message' => trans("file-manager::media.message.file_url_cannot_upload", [
                'url' => $url
            ])
        ];
    }
}
