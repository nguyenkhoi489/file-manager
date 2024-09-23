<?php

namespace Nguyenkhoi\FileManager\Repositories\Folders;

use Nguyenkhoi\FileManager\Model\MediaFolder;
use Nguyenkhoi\FileManager\Repositories\MediaBaseRepository;

class MediaFolderRepository extends MediaBaseRepository implements MediaFolderRepositoryInterface
{
    public function getModel()
    {
        return MediaFolder::class;
    }
}
