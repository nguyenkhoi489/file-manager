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
        public MediaFileRepositoryInterface $fileRepo,
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

        $data['paged'] = $data['paged'] ?? $paged;
        $data['posts_per_page'] = $data['posts_per_page'] ?? $limit;

        $allFolders = $this->folderRepository->getAllFolders($data);

        if (count($allFolders) < $limit) {
            $limit = $limit - count($allFolders);
            $data['posts_per_page'] = $limit;

            $allFiles = $this->fileRepository->getAllFiles($data);
        }
    }
}
