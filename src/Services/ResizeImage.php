<?php

namespace NguyenKhoi\FileManager\Services;

use Imagick;
use ImagickException;
use NguyenKhoi\FileManager\Services\Trait\DiskServices;

class ResizeImage
{
    use DiskServices;

    public $image;
    public string $path;
    public int $width;
    public int $height;
    public int $x;
    public int $y;
    protected $disk;

    public function __construct()
    {
        $this->disk = $this->getDisk();
    }

    /**
     * @throws ImagickException
     */
    public function setImageData(array $data): static
    {
        $this->path = $data['path'];
        $this->image = new Imagick($this->disk->path($data['path']));
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->x = $data['x'];
        $this->y = $data['y'];

        return $this;
    }


    public function resize(): array
    {
        $this->image->cropImage(
            $this->width,
            $this->height,
            $this->x,
            $this->y
        );

        return $this->saveImage($this->path, $this->image->getImageBlob());
    }

    public function saveImage(string $path, string $data): array
    {
        if (!$data) return [
            'success' => false,
            'message' => 'File crop error',
        ];
        $isPut = $this->disk->put($path, $data);
        if ($isPut) {
            return [
                'success' => true,
                'data' => [
                    'size' => $this->disk->size($path)
                ],
            ];
        }
        return [
            'success' => false,
            'message' => 'File crop error',
        ];
    }
}
