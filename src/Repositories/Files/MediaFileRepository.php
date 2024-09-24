<?php

namespace NguyenKhoi\FileManager\Repositories\Files;

use NguyenKhoi\FileManager\Model\MediaFile;
use NguyenKhoi\FileManager\Repositories\MediaBaseRepository;

class MediaFileRepository extends MediaBaseRepository implements MediaFileRepositoryInterface
{

    public function getModel()
    {
        return MediaFile::class;
    }
    public function filter(array $data)
    {
        $this->model->latest('id');

        $paged = $data['paged'] ?? 1;

        $limit = $data['posts_per_page'] ?? 30;

        $offset = ($paged - 1) * $limit;

        $this->model->limit($limit)->offset($offset);

        if (isset($data['folder_id'])) {
            $this->model->where('folder_id', $data['folder_id']);
        }

        if (isset($data['sort_by'])) {
            $order = explode('-', $data['sort_by']);
            $this->model->orderBy($order[0], $order[1]);
        }
        if (isset($data['search'])) {
            $this->model->where('name', 'like', '%' . $data['search'] . '%');
        }

        return $this->model->get();
    }
    public function getAllFiles(array $data = [])
    {

    }
}
