<?php

namespace NguyenKhoi\FileManager\Repositories\Settings;

use NguyenKhoi\FileManager\Model\MediaSetting;
use NguyenKhoi\FileManager\Repositories\MediaBaseRepository;

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
