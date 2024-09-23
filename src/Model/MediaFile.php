<?php

namespace NguyenKhoi\FileManager\Model;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'media_files';
    protected $fillable = [
        'name',
        'alt',
        'permalink',
        'size',
        'mine_type',
        'user_id',
        'folder_id',
        'deleted_at'
    ];
}
