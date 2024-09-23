<?php

namespace NguyenKhoi\FileManager\Repositories\Folders;

use NguyenKhoi\FileManager\Repositories\MediaBaseRepositoryInterface;

interface MediaFolderRepositoryInterface extends MediaBaseRepositoryInterface
{
    public function getAllFolders(array $data);

    public function filter(array $data);
}
