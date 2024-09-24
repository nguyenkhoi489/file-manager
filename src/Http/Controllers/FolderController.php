<?php

namespace NguyenKhoi\FileManager\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use NguyenKhoi\FileManager\Http\Request\FolderRequest;
use NguyenKhoi\FileManager\Repositories\Folders\MediaFolderRepositoryInterface;
use NguyenKhoi\FileManager\Services\UploadServices;

class FolderController extends Controller
{
    protected $folderRepository;
    protected $diskService;

    public function __construct(
        public MediaFolderRepositoryInterface $mediaFolderRepository,
        public UploadServices                 $uploadServices
    )
    {
        $this->folderRepository = $mediaFolderRepository;
        $this->diskService = $uploadServices;
    }

    public function saveFolder(FolderRequest $request): JsonResponse
    {
        $data = $request->validated();

        $results = $this->uploadServices->createDir($data['name']);

        if (! $results['success']) {
            return response()->json($results);
        }
        $data = array_merge($data, [
            'permalink' => $results['path'],
            'user_id' => $request->user()->id,
        ]);
        $created = $this->folderRepository->create($data);

        if (! $created) {
            return response()->json([
                'success' => false,
                'message' => $results['message']
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => $results['message']
        ]);
    }
}