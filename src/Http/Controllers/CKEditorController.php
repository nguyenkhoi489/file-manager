<?php

namespace NguyenKhoi\FileManager\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use NguyenKhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;
use NguyenKhoi\FileManager\Repositories\Folders\MediaFolderRepositoryInterface;
use NguyenKhoi\FileManager\Services\FileServices;
use NguyenKhoi\FileManager\Services\FolderServices;
use NguyenKhoi\FileManager\Http\Request\CKEditorRequest;

class CKEditorController extends Controller
{
    protected $folderService;
    protected $fileService;

    protected $fileRepository;

    protected $folderRepository;

    public function __construct(
        public MediaFolderRepositoryInterface $mediaFolderRepository,
        public MediaFileRepositoryInterface   $mediaFileRepository,
        public FolderServices                 $folderServices,
        public FileServices                   $fileServices,
    )
    {
        $this->folderService = $folderServices;
        $this->fileRepository = $mediaFileRepository;
        $this->folderRepository = $mediaFolderRepository;
        $this->fileService = $fileServices;
    }

    public function uploadCKEditor(Request $request): JsonResponse
    {

        $validated = Validator::make($request->all(), [
            'upload' => [
                'required',
                'file',
                'mimetypes:' . implode(',', config('file-manager.mime_types')) . '',
                'extensions:' . implode(',', config('file-manager.extensions')) . '',
                'max:' . config('file-manager.max_file_size') / 1024 . '',
            ],
        ]);

        if ($validated->fails()) {
            return response()->json([
                'error' => [
                    'message' => $validated->errors()->first()
                ],
            ]);
        }

        $files = $this->fileService->uploadMultipleFile($request->file('upload'), null);

        $request->merge(['folderId' => 0]);

        $uploadedFiles = $this->fileRepository->updateFile($files, $request);

        if (!$uploadedFiles['success']) {
            return response()->json([
                'error' => [
                    'message' => $uploadedFiles['message']
                ],
            ]);
        }
        return response()->json([
            'uploaded' => 1,
            'fileName' => $files[0]['data']['name'],
            'url' => url(config('file-manager.base_path') . $files[0]['data']['permalink'])
        ]);
    }


}