<?php

namespace NguyenKhoi\FileManager\Command;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use NguyenKhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;
use NguyenKhoi\FileManager\Repositories\Folders\MediaFolderRepositoryInterface;

class HandleMediaDeleted extends Command
{
    public function __construct(
        public MediaFileRepositoryInterface $mediaFileRepository,
        public MediaFolderRepositoryInterface $mediaFolderRepository
    ) {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ckmedia:handle-media-deleted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle Media Delete';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $allFolders = $this->mediaFolderRepository->getDelete();
        $allFiles = $this->mediaFileRepository->getDelete();

        foreach ($allFiles as $file) {
            $filePath = public_path(config('file-manager.path_folder') . $file->permalink);
            if (Carbon::parse($file->deleted_at)->lt(Carbon::now()) && File::exists($filePath)) {
                File::delete($filePath);
                $file->delete();
            }
        }
        foreach ($allFolders as $folder) {
            $folderPath = public_path(config('file-manager.path_folder') . $file->permalink);
            if (Carbon::parse($folder->deleted_at)->lt(Carbon::now()) && File::exists($folderPath)) {
                File::delete($folderPath);
                $folder->delete();
            }
        }

    }
}
