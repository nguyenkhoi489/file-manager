<?php

namespace NguyenKhoi\FileManager\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use NguyenKhoi\FileManager\Http\Request\FileRequest;
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

    public function uploadFileUrl(Request $request): JsonResponse
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

        return response()->json($this->updateDatabase($filePath,$request));
    }

    public function uploadFile(FileRequest $request): JsonResponse
    {
        $data = $request->validated();

        $folder = $request->get('folderId');
        if ($folder) {
            $folder = $this->folderRepository->find($request->get('folderId'));
            if (!$folder) {
                return response()->json([
                    'success' => false,
                    'message' => "The folder not found.",
                ]);
            }
        }

        $files = $this->fileService->uploadMultipleFile($data['files'], $folder);

        return response()->json($this->updateDatabase($files,$request));
    }

    protected function updateDatabase($files,$request): array
    {
        if (!count($files)) {
            return [
                'success' => false,
                'message' => "The files could not be uploaded.",
            ];
        }
        $data = collect($files)->map(function ($item) use ($request) {
            $data = $item['data'];
            $data['user_id'] = $request->user()->id;
            $data['folder_id'] = $request->get('folderId');
            return $data;
        })->toArray();

        $insertItem = $this->fileRepository->insert($data);

        if (!$insertItem) {
            return [
                'success' => false,
                'message' => "The files could not be uploaded.",
            ];
        }
        return [
            'success' => true,
            'message' => "The files has been uploaded.",
        ];
    }
}
