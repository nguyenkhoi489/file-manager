<?php

namespace NguyenKhoi\FileManager\Model;

use Illuminate\Database\Eloquent\Model;

class MediaFolder extends Model
{
    protected $table = 'media_folders';

    protected $fillable = [
        'name',
        'permalink',
        'user_id',
        'parent_id',
        'deleted_at'
    ];
}
