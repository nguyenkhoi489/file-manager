<?php

namespace NguyenKhoi\FileManager\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use NguyenKhoi\FileManager\Http\Request\MediaRequest;
use NguyenKhoi\FileManager\Http\Request\MediaUpdateRequest;
use NguyenKhoi\FileManager\Http\Resources\FileResource;
use NguyenKhoi\FileManager\Http\Resources\FolderResource;
use NguyenKhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;
use NguyenKhoi\FileManager\Repositories\Folders\MediaFolderRepositoryInterface;
use NguyenKhoi\FileManager\Services\FileServices;
use NguyenKhoi\FileManager\Services\FolderServices;

class MediaController extends Controller
{
    private $fileRepository;
    private $folderRepository;
    private $folderServices;
    private $fileServices;

    public function __construct(
        public MediaFileRepositoryInterface   $fileRepo,
        public MediaFolderRepositoryInterface $folderRepo,
        public FolderServices                 $folderSer,
        public FileServices                   $fileSer,
    )
    {
        $this->fileRepository = $this->fileRepo;
        $this->folderRepository = $this->folderRepo;
        $this->folderServices = $folderSer;
        $this->fileServices = $fileSer;
    }

    public function index(Request $request)
    {
        $isChoose = $request->get('isChoose') ?? false;
        return view('file-manager::master', compact('isChoose'));
    }

    public function loadMedia(MediaRequest $request): JsonResponse
    {
        $limit = file_manager_setting('media_limit', 30);

        Artisan::call('optimize:clear');

        $data = $request->validated();
        $isTrash = $request->get('view_in') == 'trash';
        $data['is_trash'] = $isTrash;

        $breadcrumbs = [
            0 => [
                "id" => 0,
                "name" => "All Media",
                "icon" => "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                            <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                            <path d=\"M15 8h.01\"></path>\n                            <path d=\"M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z\"></path>\n                            <path d=\"M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5\"></path>\n                            <path d=\"M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3\"></path>\n                        </svg>"
            ]
        ];
        if (isset($data['folder_id']) && $data['folder_id']) {
            $breadcrumbs = array_merge($breadcrumbs, $this->getBreadcrumbs($data['folder_id']));
        }

        $allFiles = [];

        $data['paged'] = $data['paged'] ?? 1;

        $limit = $data['posts_per_page'] = $data['posts_per_page'] ?? $limit;

        if ($request->user() && isset($request->user()->role_id) && $request->user()->role_id !== 1) {
            $data['user_id'] = $request->user()->id;
        }
        $countFolders = $this->folderRepository->getCount($data);
        $countFiles = $this->fileRepository->getCount($data);
        if ($data['load_more'] == 'false') {

            $allFolders = $this->folderRepository->filter($data);
            if (count($allFolders) < $data['posts_per_page']) {
                $limit_post = $data['posts_per_page'] - count($allFolders);

                $data['posts_per_page'] = $limit_post;
                $allFiles = $this->fileRepository->filter($data);
            }
            return response()->json([
                'success' => true,
                'data' => [
                    'breadcrumbs' => $breadcrumbs,
                    'folders' => FolderResource::collection($allFolders),
                    'files' => FileResource::collection($allFiles),
                ],
                'load_more' => $countFolders > $limit || $countFiles > $limit,
                'next' => (int)$data['paged'] + 1,
                'type' => $countFolders > (int)$limit ? 'folder' : 'file'
            ]);
        }
        $dataResponse = [];
        switch ($data['type']) {
            case 'file':
                $dataResponse['file'] = $this->fileRepository->filter($data);
                break;
            case 'folder':
                $dataResponse['folder'] = $this->folderRepository->filter($data);
                break;
        }
        return response()->json([
            'success' => true,
            'data' => [
                'breadcrumbs' => $breadcrumbs,
                'folders' => isset($dataResponse['folder']) ? FolderResource::collection($dataResponse['folder']) : null,
                'files' => isset($dataResponse['file']) ? FileResource::collection($dataResponse['file']) : null,
            ],
            'load_more' => ($countFolders > $limit * $data['paged']) || ($countFiles > $limit * $data['paged']),
            'next' => (int)$data['paged'] + 1,
            'type' => $data['type']
        ]);
    }

    public function updateName(MediaUpdateRequest $request): JsonResponse
    {

        $data = $request->validated();

        $repoUsed = $data['is_folder'] !== 'false' ? $this->folderRepository : $this->fileRepository;
        $serUsed = $data['is_folder'] !== 'false' ? $this->folderServices : $this->fileServices;

        $isExits = $repoUsed->find($data['id']);

        if (!$isExits) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.not_found')
            ]);
        }
        $isChecked = $serUsed->find($isExits->permalink);

        if (!$isChecked) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.not_found')
            ]);
        }
        $parentFolder = null;

        if ($isExits->parent_id ?? $isExits->folder_id) {
            $findFolder = $this->folderRepository->find($isExits->parent_id ?? $isExits->folder_id);
            $parentFolder = $findFolder->permalink;
        }

        $changed = $serUsed->renameItem($isExits, $data['name'], $parentFolder);

        if (!$changed['success']) {

            return response()->json($changed);
        }

        $_updateData = [
            'name' => $data['name'],
            'permalink' => $changed['path']
        ];

        if (isset($changed['alt'])) {
            $_updateData['alt'] = $changed['alt'];
        }
        $repoUsed->update($isExits->id, $_updateData);

        return response()->json($changed);
    }

    public function removeTrash(MediaUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $repoUsed = $data['is_folder'] !== 'false' ? $this->folderRepository : $this->fileRepository;

        $isExits = $repoUsed->find($data['id']);

        if (!$isExits) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.not_found')
            ]);
        }

        $repoUsed->update($isExits->id, [
            'deleted_at' => Carbon::now()->addDays(7)
        ]);

        return response()->json([
            'success' => true,
            'message' => trans('file-manager::media.trash_success')
        ]);
    }

    public function restoreTrash(MediaUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $repoUsed = $data['is_folder'] !== 'false' ? $this->folderRepository : $this->fileRepository;

        $isExits = $repoUsed->find($data['id']);

        if (!$isExits) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.not_found')
            ]);
        }

        $repoUsed->update($isExits->id, [
            'deleted_at' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => trans('file-manager::media.restore_success')
        ]);
    }

    public function removeNotRestore(MediaUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $repoUsed = $data['is_folder'] !== 'false' ? $this->folderRepository : $this->fileRepository;

        $isExits = $repoUsed->find($data['id']);

        if (!$isExits) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.not_found')
            ]);
        }

        $isExits->delete();

        return response()->json([
            'success' => true,
            'message' => trans('file-manager::media.trash_success')
        ]);
    }

    public function emptyAllTrash(): JsonResponse
    {
        $this->fileRepository->getQuery()->whereNotNull('deleted_at')->delete();
        $this->folderRepository->getQuery()->whereNotNull('deleted_at')->delete();
        return response()->json([
            'success' => true,
            'message' => trans('file-manager::media.empty_trash_success')
        ]);
    }

    private function getBreadcrumbs($folder_id): array
    {
        $breadcrumbs = [];
        $folder = $this->folderRepository->find($folder_id);
        if ($folder) {
            $breadcrumbs[] = [
                'id' => $folder->id,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
            </svg>',
                'name' => ucfirst($folder->name)
            ];

            if ($folder->parent_id) {
                $breadcrumbs = array_merge($this->getBreadcrumbs($folder->parent_id), $breadcrumbs);
            }
        }
        return $breadcrumbs;
    }
}
