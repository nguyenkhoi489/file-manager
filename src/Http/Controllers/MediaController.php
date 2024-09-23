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
        dd($this->folderRepository->getAllFolders($request->all()));
        return response()->json($request->all());
    }
}
