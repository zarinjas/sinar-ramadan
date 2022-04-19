<?php

namespace App\Models\Billplz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Znck\Eloquent\Traits\BelongsToThrough;

class CommentByBill extends Model
{
    use HasFactory, BelongsToThrough, AsSource, Filterable;

    protected $table = 'comment_by_bills';
    protected $fillable = [
        'bill_id', 
        'comment_content', 
    ];

    /**
     * Get the bill that owns the CommentByBill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    /**
     * Get the collection that owns the CommentByBill
     *
     * @return \Znck\Eloquent\Traits\BelongsToThrough
     */
    public function collection() 
    {
        return $this->belongsToThrough(Collection::class, Bill::class);
    }
}
