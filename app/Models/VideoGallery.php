<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoGallery extends Model
{
    use HasFactory, AsSource;

    protected $table = 'video_galleries';

    protected $fillable = [
        'video_name',
        'youtube_id',
        'gallery_id',
        'video_thumbnail'
    ];

     /**
     * Get the thumbnail associated with the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thumbnail(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'video_thumbnail');
    }
}
