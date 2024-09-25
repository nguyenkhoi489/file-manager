<?php

namespace NguyenKhoi\FileManager\Repositories\Files;

use NguyenKhoi\FileManager\Repositories\MediaBaseRepositoryInterface;

interface MediaFileRepositoryInterface extends MediaBaseRepositoryInterface
{
    public function filter(array $data);


    public function findByFolderId($folderId);

    public function updateFileByPermalink($permalink, array $data);
}
