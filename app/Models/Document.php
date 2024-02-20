<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    const CREATED_AT = 'date_uploaded';
    const UPDATED_AT = 'date_last_updated';

    protected $fillable = [
        'title',
        'program',
        'date_submitted',
    ];

    public function authors() {
        return $this->belongsToMany(Author::class, 'documents_authors', 'document_id', 'author_id');
    }

    public function scopeHasKeyword($query, ?string $keywords) {
        $keywordsArray = explode(' ', $keywords);   // Separates keywords into an array, words must have a space between them

        $query->where(function ($query) use($keywordsArray) {   // Loops through each keyword when querying
            foreach ($keywordsArray as $keyword) {
                $query->whereHas('authors', function($query) use ($keyword) {   // Checks if keyword is found in the author names
                    $query->where('first_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $keyword . '%');
                })
                    ->orWhere('title', 'LIKE', '%' . $keyword . '%')            // Checks if keyword is found in the title
                    ->orWhere('excerpt', 'LIKE', '%' . $keyword . '%');         // Checks if keyword is found in the excerpt
            }
        });
    }

    public function scopeByDate($query, ?string $dateFrom, ?string $dateTo) {
        $query->when($dateFrom, function($query, string $dateFrom) {
                $query->whereDate('date_submitted', '<=', $dateFrom);
            })
            ->when($dateTo, function($query, string $dateTo) {
                $query->whereDate('date_submitted', '>=', $dateTo);
            });
    }

    public function scopeSortBy($query, ?string $attribute) {
        $params = null;

        if($attribute && $attribute != '') $params = explode(' ', $attribute);
        

        $query->when($params, function($query, $params) {
                $query->orderBy($params[0], $params[1]);
            });
    }

    public function scopeByProgram($query, ?string $program) {
        $query->when($program, function($query, string $program) {
            $query->where('program', '=', $program);
        });
    }

    public function scopeShowTrashed($query, ?bool $trashed) {
        if($trashed) $query->onlyTrashed();
    }

    /* 
        If a document has been soft-deleted for more than a month,
        they will be permanently deleted from the database.
    */
    public function prunable() {
        return static::where('deleted_at', '<=', now()->subMonth());
    }

    /* 
        Files and relationships with authors will also be deleted
    */
    protected function pruning() {
        Storage::delete('documents/' . strtolower($this->program) . '/' . $this->file_name);
        Storage::delete('public/thumbnails/' . $this->id . '.jpg');
    }
}
