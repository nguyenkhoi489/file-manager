<?php

namespace Nguyenkhoi\FileManager\Repositories\Settings;

use Nguyenkhoi\FileManager\Model\MediaSetting;
use Nguyenkhoi\FileManager\Repositories\MediaBaseRepository;

class MediaSettingRepository extends MediaBaseRepository implements MediaSettingRepositoryInterface
{

    public function getModel()
    {
        return MediaSetting::class;
    }

    public function getByKey(string $key)
    {
        return $this->model->where('key', $key)->first();
    }

}
