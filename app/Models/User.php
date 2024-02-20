<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Prunable, CanResetPassword;

    protected $fillable = [
        'username',
        'email',
        'password',
        'is_admin',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'password' => 'hashed',
    ];

    public function scopeHasKeyword($query, ?string $keywords) {
        $keywordsArray = explode(' ', $keywords);   // Separates keywords into an array, words must have a space between them

        $query->where(function ($query) use($keywordsArray) {   // Loops through each keyword when querying
            foreach ($keywordsArray as $keyword) {
                $query->where('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $keyword . '%');
            }   
        });
    }

    public function scopeByDate($query, ?string $dateFrom, ?string $dateTo) {
        $query->when($dateFrom, function($ifQuery, string $dateFrom) {
                $ifQuery->whereDate('created_at', '>=', $dateFrom);
            })
            ->when($dateTo, function($ifQuery, string $dateTo) {
                $ifQuery->whereDate('created_at', '<=', $dateTo);
            })
        ;
    }

    public function scopeSortBy($query, ?string $attribute) {
        $params = null;

        if($attribute && $attribute != '') $params = explode(' ', $attribute);
        
        $query->when($params, function($query, $params) {
                $query->orderBy($params[0], $params[1]);
            });
    }

    public function scopeShowTrashed($query, ?string $trashed) {
        if($trashed) $query->onlyTrashed();
    }

    public function scopeByAccessLevel($query, ?int $isAdmin) {
        $query->when(isset($isAdmin), function($ifQuery) use($isAdmin) {
            $ifQuery->where('is_admin', $isAdmin);
        });
    }

    /* 
        If a user has been soft-deleted for more than a month,
        they will be permanently deleted from the database.
    */
    public function prunable() {
        return static::where('deleted_at', '<=', now()->subMonth());
    }
}
