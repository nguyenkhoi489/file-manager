<?php

namespace NguyenKhoi\FileManager\Repositories\Folders;

use NguyenKhoi\FileManager\Model\MediaFolder;
use NguyenKhoi\FileManager\Repositories\MediaBaseRepository;

class MediaFolderRepository extends MediaBaseRepository implements MediaFolderRepositoryInterface
{
    public function getModel()
    {
        return MediaFolder::class;
    }

    public function filter(array $data): void
    {
        $this->model->latest('id');

        $paged = $data['paged'] ?? 1;

        $limit = $data['posts_per_page'] ?? 30;

        $offset = ($paged - 1) * $limit;

        $this->model->limit($limit)->offset($offset);

        if (isset($data['folder_id'])) {
            $this->model->where('parent_id', $data['folder_id']);
        }

        if (isset($data['sort_by'])) {
            $order = explode('-', $data['sort_by']);
            $this->model->orderBy($order[0], $order[1]);
        }
        if (isset($data['search'])) {
            $this->model->where('name', 'like', '%' . $data['search'] . '%');
        }
    }
    public function getAllFolders(array $data)
    {
        $this->filter($data);

    }
}
