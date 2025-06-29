<?php

namespace NguyenKhoi\FileManager\Services\Trait;


use Illuminate\Support\Facades\Storage;
use function config;

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
            'driver' => config('file-manager.diskList'),
            'root' => public_path(config('file-manager.path_folder')),
        ]);
        return $this;
    }

    public function getDisk()
    {
        return $this->disk;
    }
}
