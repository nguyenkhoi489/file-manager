<?php

namespace Nguyenkhoi\FileManager\Repositories\Files;

use App\Repositories\BaseRepository;
use Nguyenkhoi\FileManager\Model\MediaFile;
use Nguyenkhoi\FileManager\Repositories\MediaBaseRepository;

class MediaFileRepository extends MediaBaseRepository implements MediaFileRepositoryInterface
{

    public function getModel()
    {
        return MediaFile::class;
    }
}
