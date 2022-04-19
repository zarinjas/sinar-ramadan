<?php

namespace App\Models;

use App\Models\Group;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $table = 'contacts';

    protected $fillable = [
        'contact_name', 
        'contact_no', 
        'group_id',
    ];

    /**
     * Get the group that owns the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
