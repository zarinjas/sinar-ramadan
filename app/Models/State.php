<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class State extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $table = 'states';

    protected $fillable = [
        'state_name',
        'state_code',
        'subdivision'
    ];

    /**
     * Get all of the groups for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'state_id', 'id');
    }

    /**
     * Get all of the accounts for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function accounts(): HasManyThrough
    {
        return $this->hasManyThrough(Account::class, Group::class);
    }

    /**
     * Get all of the contacts for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function contacts(): HasManyThrough
    {
        return $this->hasManyThrough(Contact::class, Group::class);
    }
}
