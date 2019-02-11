<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserAllProfites()
    {
        $userProfites = UserScore::getUserScore();
        $surprise = [];
        foreach (UsersSurprise::getUserSurpriseIds() as $surp) {
            $surprise[] = Surprise::find($surp->surprise_id)->name;
        }
        $surprise = implode(", ", $surprise);
        $userProfites->surprise = $surprise;

        return $userProfites;
    }
}
