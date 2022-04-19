<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Platform\Models\User;
use Orchid\Attachment\Attachable;
use App\Models\Billplz\Collection;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $table = 'programs';
    protected $fillable = [
        'program_title', 
        'program_slug', 
        'program_content',  
        'is_publish', 
        'user_id',
        'thumbnail_id'
    ];

    /**
     * Get the author that owns the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the gallery for the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'program_id', 'id');
    }

    /**
     * Get all of the collections for the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collections()
    {
        return $this->belongsToMany(Collection::class)
                    ->as('collections');
    }


    /**
     * Get the thumbnail associated with the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thumbnail()
    {
        return $this->hasOne(Attachment::class, 'id', 'thumbnail_id')->withDefault();
    }

    /**
     * scope function query by program slug
     *
     * @param Query $query
     * @param string $slug
     * @return Illuminate\Http\Response
     */
    public function scopeWhereSlug($query, $slug = null)
    {
        return $query->where('program_slug', $slug);
    }
}
