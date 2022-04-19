<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $table = 'galleries';
    protected $fillable = [
        'gallery_name', 
        'gallery_description', 
        'program_id',
        'show_in_homepage'
    ];

    /**
     * Get the program that owns the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }


    /**
     * Get all of the photos for the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Attachment::class)->where('group', 'photos');
    }

    /**
     * Get all of the videos for the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(VideoGallery::class, 'gallery_id', 'id');
    }
}
