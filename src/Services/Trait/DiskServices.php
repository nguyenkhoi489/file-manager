<?php

namespace NguyenKhoi\FileManager\Services\Trait;


use Illuminate\Support\Facades\Storage;

trait DiskServices
{
    protected $disk;

    public function __construct()
    {
        $this->setDisk();
    }

    protected function setDisk(): static
    {
        $this->disk = Storage::build([
            'driver' => file_manager_setting('default_disk', 'local'),
            'root' => public_path(\config('file-manager.path_folder')),
        ]);
        return $this;
    }

    public function getDisk()
    {
        return $this->disk;
    }
}
