<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Author extends Model
{
    use HasFactory;
    use Prunable;

    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_last_updated';

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public function documents() {
        return $this->belongsToMany(Document::class, 'documents_authors', 'author_id', 'document_id');
    }

    /* 
        If an author inside the database does not have
        a document written by them, they are removed.
    */
    public function prunable() {
        return static::has('documents', '=', 0);
    }
}
