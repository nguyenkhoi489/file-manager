<?php

namespace NguyenKhoi\FileManager\Repositories\Folders;

use NguyenKhoi\FileManager\Repositories\MediaBaseRepositoryInterface;

interface MediaFolderRepositoryInterface extends MediaBaseRepositoryInterface
{
    public function filter(array $data);
    public function getCount(array $data);
    public function getDelete();
}
