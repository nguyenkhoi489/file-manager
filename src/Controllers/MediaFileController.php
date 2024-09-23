<?php

namespace Nguyenkhoi\FileManager\Controllers;

use App\Http\Controllers\Controller;
use Nguyenkhoi\FileManager\Repositories\Files\MediaFileRepositoryInterface;

class MediaFileController extends Controller
{
    protected $fileRepository;

    public function __construct(
        public MediaFileRepositoryInterface $fileRepo
    )
    {
        $this->middleware(config('file-manager.middleware'));
        $this->fileRepository = $this->fileRepo;
    }

    public function index()
    {
        dd(123);
    }
}
