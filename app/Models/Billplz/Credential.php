<?php

namespace App\Models\Billplz;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credential extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $table = 'credentials';
    protected $fillable = [
        'credential_name',
        'credential_description',
        'api_key',
        'x_signature',
        'credential_logo'
    ];

    /**
     * Get all of the collections for the Credential
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collections() 
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * Get all of the bills for the Credential
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Collection::class);
    }


    /**
     * Get the logo associated with the Credential
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function logo()
    {
        return $this->hasOne(Attachment::class, 'id', 'credential_logo')->withDefault();
    }
}
