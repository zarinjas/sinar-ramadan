<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $fillable = [
        'book_name',
        'book_description',
        'is_redirect',
        'book_url',
        'book_pdf',
        'book_thumbnail',
        'category_id'
    ];


    /**
     * Get the pdf associated with the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pdf(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'book_pdf');
    }

    /**
     * Get the thumbnail associated with the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thumbnail(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'book_thumbnail');
    }


    /**
     * Get the category that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
