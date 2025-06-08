<?php

namespace NguyenKhoi\FileManager\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use NguyenKhoi\FileManager\Http\Request\FileCropRequest;
use NguyenKhoi\FileManager\Http\Request\FileRequest;
use NguyenKhoi\FileManager\Http\Request\FileUpdateRequest;
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
                'url.required' => trans('file-manager::media.message.url'),
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
        return response()->json($this->fileRepository->updateFile($filePath, $request));
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
                    'message' => trans('file-manager::media.message.folder_not_found'),
                ]);
            }
        }

        $files = $this->fileService->uploadMultipleFile($data['files'], $folder);

        $isError = collect($files)->filter(function ($file) {
            if (!$file['success']) {
                return $file;
            }
        });

        if ($isError->count() === 0) {
            return response()->json($this->fileRepository->updateFile($files, $request));
        }

        return response()->json($isError->first());
    }

    public function saveCropImage(FileCropRequest $request): JsonResponse
    {

        $validate = $request->validated();

        $file = $this->fileRepository->find($validate['image_id']);

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.message.file_not_found'),
            ]);
        }
        $cropResult = $this->fileService->cropImage($file->permalink, $validate['crop_data']);

        if (!$cropResult['success']) {
            return response()->json($cropResult);
        }
        return response()->json($this->fileRepository->updateSize($validate['image_id'], $cropResult['data']));

    }

    public function updateData(FileUpdateRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $file = $this->fileRepository->find($validate['id']);

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.message.file_not_found'),
            ]);
        }

        $updated = $this->fileRepository->update($validate['id'], $validate);
        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => trans('file-manager::media.message.file_not_found'),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => trans('file-manager::media.message.update_success'),
        ]);
    }
}
