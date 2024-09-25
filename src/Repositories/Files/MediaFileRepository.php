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
        $model = $this->model->query();

        $model->whereNull('deleted_at');

        $paged = $data['paged'] ?? 1;

        $limit = $data['posts_per_page'] ?? 30;

        $offset = ($paged - 1) * $limit;

        $model->limit($limit)->offset($offset);

        $model->where(function ($query) use ($data) {
            if (isset($data['folder_id'])) {
                $query->where('folder_id', $data['folder_id']);
            }
            if (isset($data['search']) && $data['search']) {
                $query->where('name', 'like', '%' . $data['search'] . '%');
            }
        });

        if (isset($data['sort_by'])) {
            $order = explode('-', $data['sort_by']);
            $model->orderBy($order[0], $order[1]);
        }

        return $model->get();
    }

    public function getCount()
    {
        return $this->model->whereNull('deleted_at')->count('id');
    }

    public function findByFolderId($folderId)
    {
        return $this->model->where('folder_id', $folderId)->get();
    }

    public function updateFileByPermalink($permalink, array $data)
    {
        return $this->model->where('permalink', $permalink)->update($data);
    }
}
