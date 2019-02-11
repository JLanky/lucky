<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UsersSurprise extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'users_surprise';

    /**
     * @var bool $timestamps
     */
    public $timestamps = true;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'user_id',
        'surprise_id'
    ];

    public static function getUserSurpriseIds()
    {
        return self::where('user_id', Auth::user()->id)->get();
    }
}
