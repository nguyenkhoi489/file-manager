<?php

namespace NguyenKhoi\FileManager\Model;

use Illuminate\Database\Eloquent\Model;

class MediaSetting extends Model
{
    protected $table = 'media_settings';
    protected $fillable = [
        'key',
        'value'
    ];
}
