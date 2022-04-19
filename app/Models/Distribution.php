<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Attachment\Attachable;

class Distribution extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $table = 'distributions';

    protected $fillable = [
        'distribution_name',
        'group_id',
        'location',
        'receiver',
        'distribute_amount'
    ];

    /**
     * Get the group that owns the Distribution
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
