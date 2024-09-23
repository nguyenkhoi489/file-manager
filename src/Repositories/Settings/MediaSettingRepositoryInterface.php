<?php

namespace NguyenKhoi\FileManager\Repositories\Settings;

use NguyenKhoi\FileManager\Repositories\MediaBaseRepositoryInterface;

interface MediaSettingRepositoryInterface extends MediaBaseRepositoryInterface
{
    public function getByKey(string $key);

}
