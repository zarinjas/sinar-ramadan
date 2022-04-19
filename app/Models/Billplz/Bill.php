<?php

namespace App\Models\Billplz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
use Znck\Eloquent\Traits\BelongsToThrough;

class Bill extends Model
{
    use HasFactory, AsSource, BelongsToThrough, Filterable, Chartable;

    protected $table = 'bills';
    protected $fillable = [
        'bill_id',
        // 'collection_id', 
        'donator_name', 
        'is_anonymous', 
        'paid_amount', 
        'paid_at'
    ];

    // /**
    //  * Get the collection that owns the Bill
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function collection()
    // {
    //     return $this->belongsTo(Collection::class);
    // }

    // /**
    //  * Get the credential that owns the Bill
    //  *
    //  * @return \Znck\Eloquent\Traits\BelongsToThrough
    //  */
    // public function credential() 
    // {
    //     return $this->belongsToThrough(Credential::class, Collection::class);
    // }

    // /**
    //  * Get the comment associated with the Bill
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasOne
    //  */
    // public function comment()
    // {
    //     return $this->hasOne(CommentByBill::class);
    // }
}
