<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $table = 'groups';

    protected $fillable = [
        'group_name', 
        'group_url',
        'district', 
        'address', 
        'state_id',
        'is_main', 
        // 'collection_id',
        'group_thumbnail'
    ];


    /**
     * Get the state that owns the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    // /**
    //  * Get the collection that owns the Group
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function collection(): BelongsTo
    // {
    //     return $this->belongsTo(Collection::class);
    // }

    /**
     * Get all of the accounts for the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Get all of the contact for the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the thumbnail associated with the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thumbnail(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'group_thumbnail');
    }

    /**
     * Query for Main Group
     *
     * @param Query $query
     * @param boolean $is_main
     * @return $query
     */
    public function scopeIsMain($query, bool $is_main)
    {
        return $query->where('is_main', $is_main);
    }
}
