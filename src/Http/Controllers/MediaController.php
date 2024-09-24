<?php

namespace NguyenKhoi\FileManager\Http\Controllers;

use NguyenKhoi\FileManager\Http\Request\MediaRequest;
use NguyenKhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;
use Illuminate\Routing\Controller;
use NguyenKhoi\FileManager\Repositories\Folders\MediaFolderRepositoryInterface;

class MediaController extends Controller
{
    protected $fileRepository;
    protected $folderRepository;

    public function __construct(
        public MediaFileRepositoryInterface   $fileRepo,
        public MediaFolderRepositoryInterface $folderRepo
    )
    {
        $this->fileRepository = $this->fileRepo;
        $this->folderRepository = $this->folderRepo;
    }

    public function index()
    {
        return view('file-manager::master');
    }

    public function loadMedia(MediaRequest $request)
    {
        $paged = 1;
        $limit = 30;

        $data = $request->validated();
        $breadcrumbs = [
            0 => [
                "id" => 0,
                "name" => "All Media",
                "icon" => "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                            <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                            <path d=\"M15 8h.01\"></path>\n                            <path d=\"M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z\"></path>\n                            <path d=\"M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5\"></path>\n                            <path d=\"M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3\"></path>\n                        </svg>"
            ]
        ];
        if (isset($data['folder_id']) && $data['folder_id']) {
            $parent = $this->folderRepository->find($data['folder_id']);
            if ($parent) {
                $breadcrumbs[] = [
                    'id' => $parent->id,
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
                </svg>',
                    'name' => ucfirst($parent->name)
                ];
            }
        }

        $allFiles = [];

        $data['paged'] = $data['paged'] ?? $paged;
        $data['posts_per_page'] = $data['posts_per_page'] ?? $limit;

        $countFolders = $this->folderRepository->getCount();
        $countFiles = $this->fileRepository->getCount();

        $allFolders = $this->folderRepository->filter($data);

        if (count($allFolders) < $limit) {
            $limit = $limit - count($allFolders);
            $data['posts_per_page'] = $limit;
            $allFiles = $this->fileRepository->filter($data);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'breadcrumbs' => $breadcrumbs,
                'folders' => $allFolders,
                'files' => $allFiles,
            ],
            'load_more' => $countFolders > $limit || $countFiles > $limit,
            'type' => $countFolders > $limit ? 'folder' : 'file'
        ]);
    }
}
