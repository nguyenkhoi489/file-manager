<?php

namespace Nguyenkhoi\FileManager\Repositories\Settings;

use Nguyenkhoi\FileManager\Repositories\MediaBaseRepositoryInterface;

interface MediaSettingRepositoryInterface extends MediaBaseRepositoryInterface
{
    public function getByKey(string $key);

}
