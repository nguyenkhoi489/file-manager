<?php

namespace NguyenKhoi\FileManager\Repositories\Files;

use NguyenKhoi\FileManager\Repositories\MediaBaseRepositoryInterface;

interface MediaFileRepositoryInterface extends MediaBaseRepositoryInterface
{
    public function filter(array $data);

    public function findByFolderId($folderId);

    public function updateFileByPermalink($permalink, array $data);

    public function updateFile(array $data, $request);

    public function updateSize($id,array $size);

    public function getCount(array $data);

    public function getDelete();
}
