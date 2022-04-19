<?php

namespace App\Models\Billplz;

use App\Models\Program;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;

class Collection extends Model
{
    use HasFactory, AsSource, Filterable, Chartable;

    protected $table = 'collections';

    protected $fillable = [
        'credential_id',
        'billplz_collection_id',
        'collection_title',
        'collection_description',
        'retina_url',
        'avatar_url'
    ];

    protected $allowedFilters = [
        'id',
        'collection_id',
        'title',
    ];

    protected $allowedSorts = [
        'id',
        'title',
    ];

    /**
     * Get the credential that owns the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function credential()
    {
        return $this->belongsTo(Credential::class);
    }

    /**
     * Get all of the bills for the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * Get all of the programs for the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class)
                    ->as('programs')
                    ->withTimestamps();
    }


    /**
     * Get all of the comments for the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function comments()
    {
        return $this->hasManyThrough(CommentByBill::class, Bill::class);
    }


    public function getAllSumbanganName()
    {
        $test = Collection::select('collection_title')->get();
        return $test;
    }
}
