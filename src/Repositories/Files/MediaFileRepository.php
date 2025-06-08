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

        if (isset($data['is_trash']) && $data['is_trash']) {
            $model->whereNotNull('deleted_at');
        } else {
            $model->whereNull('deleted_at');
        }

        $paged = $data['paged'] ?? 1;
        $limit = $data['posts_per_page'] ?? 30;
        $offset = ($paged - 1) * $limit;
        $model->limit($limit);

        $model->where(function ($query) use ($data) {
            if (isset($data['folder_id'])) {
                $query->where('folder_id', $data['folder_id']);
            }
            if (isset($data['search']) && $data['search']) {
                $query->where(function ($query) use ($data) {
                    $query->where('name', 'like', '%' . $data['search'] . '%');
                    $query->orWhere('permalink', 'like', '%' . $data['search'] . '%');
                });
            }
            if (isset($data['ids']) && count($data['ids'])) {
                $query->whereNotIn('id', $data['ids']);
            }
            if (isset($data['filter_type'])) {
                switch ($data['filter_type']) {
                    case 'image':
                        $query->where('mine_type', 'like', 'image/%');
                        break;
                    case 'video':
                        $query->where('mine_type', 'like', 'video/%');
                        break;
                    case 'document':
                        $query->where(function ($q) {
                            $q->where('mine_type', 'like', 'application/pdf')
                                ->orWhere('mine_type', 'like', 'application/msword')
                                ->orWhere('mine_type', 'like', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                ->orWhere('mine_type', 'like', 'application/vnd.ms-excel')
                                ->orWhere('mine_type', 'like', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                                ->orWhere('mine_type', 'like', 'text/csv');
                        });
                        break;
                    case 'media':
                        $query->where(function ($q) {
                            $q->where('mine_type', 'like', 'image/%')
                                ->orWhere('mine_type', 'like', 'video/%');
                        });
                        break;
                    case 'everything':
                    default:
                        // Không filter gì thêm
                        break;
                }
            }
        });

        if (isset($data['sort_by'])) {
            $order = explode('-', $data['sort_by']);
            $model->orderBy($order[0], $order[1]);
        }

        return $model->get();
    }

    public function getCount($data)
    {
        $model = $this->model->whereNull('deleted_at');

        if (isset($data['folder_id'])) {
            $model = $model->where('folder_id', $data['folder_id']);
        }
        return $model->count('id');
    }

    public function findByFolderId($folderId)
    {
        return $this->model->where('folder_id', $folderId)->get();
    }

    public function updateFileByPermalink($permalink, array $data)
    {
        return $this->model->where('permalink', 'LIKE', "%$permalink%")->update($data);
    }

    public function updateFile(array $data, $request): array
    {
        if (!count($data)) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_uploaded")
            ];
        }

        $insertData = collect($data)->map(function ($item) use ($request) {
            if (isset($item['data'])) {
                $data = $item['data'];
                $data['user_id'] = $request->user()->id ?? 1;
                $data['folder_id'] = $request->get('folderId') ?? 0;
                return $data;
            }
        })->filter(function ($item) {
            if (is_array($item) && count($item)) {
                return $item;
            }
        })->toArray();

        if (!count($insertData)) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_uploaded")
            ];
        }
        $insertItem = $this->insert($insertData);

        if (!$insertItem) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_uploaded")
            ];
        }
        return [
            'success' => true,
            'message' => trans("file-manager::media.message.file_uploaded"),
            'data' => $data
        ];
    }

    public function updateSize($id, array $size): array
    {
        $file = $this->find($id);

        if (!$file) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_found")
            ];
        }

        $isUpdated = $this->update($id, $size);

        if (!$isUpdated) {
            return [
                'success' => false,
                'message' => trans("file-manager::media.message.file_not_found")
            ];
        }
        return [
            'success' => true,
            'message' => trans("file-manager::media.message.update_success")
        ];
    }

    public function getDelete()
    {
        return $this->model->whereNotNull('deleted_at')->get();
    }
}
