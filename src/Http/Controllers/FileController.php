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

class FileController extends Controller
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

    public function uploadMultiple(Request $request): JsonResponse
    {
        $validator = Validator::make($request->input(),
            [
                'url' => 'required',
                'folderId' => 'nullable|integer',
            ],
            [
                'url.required' => 'The field "url" is required.',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $folder = $this->folderRepository->find($request->get('folderId'));

        $folder = $folder->permalink ?? "";

        $filePath = $this->fileService->uploadByURL(trim($request->get('url')), $folder);

        if (!count($filePath)) {
            return response()->json([
                'success' => false,
                'message' => "The files could not be uploaded.",
            ]);
        }
        $data = collect($filePath)->map(function ($item) use ($request) {
            $data = $item['data'];
            $data['user_id'] = $request->user()->id;
            $data['folder_id'] = $request->get('folderId');
            return $data;
        })->toArray();

        $insertItem = $this->fileRepository->insert($data);

        if (!$insertItem) {
            return response()->json([
                'success' => false,
                'message' => "The files could not be uploaded.",
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => "The files has been uploaded.",
        ]);
    }
}
