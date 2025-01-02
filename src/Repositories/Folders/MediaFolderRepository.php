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
                $query->where('parent_id', $data['folder_id']);
            }
            if (isset($data['search']) && $data['search']) {
                $query->where('name', 'like', '%' . $data['search'] . '%');
            }
            if (isset($data['ids']) && count($data['ids'])) {
                $query->whereNotIn('id', $data['ids']);
            }
        });

        if (isset($data['sort_by'])) {
            $order = explode('-', $data['sort_by']);
            if ($order[0] !== 'size') {
                $model->orderBy($order[0], $order[1]);
            }
        }

        return $model->get();
    }

    public function getCount($data)
    {

        $model =  $this->model->whereNull('deleted_at');
             
        if(isset($data['folder_id'])){
            $model= $model->where(function($query) use ($data){
                $query->where('id', $data['folder_id']);
                $query->orWhere('parent_id', $data['folder_id']);
            });
        }
        return $model->count('id');
    }
    public function getDelete() {
        return  $this->model->whereNotNull('deleted_at')->get();
    }
}
