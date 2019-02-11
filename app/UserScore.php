<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserScore extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'user_score';

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
        'money',
        'bonus',
    ];

    /**
     * @return mixed
     */
    public static function getUserScore()
    {
        return self::where('user_id', Auth::user()->id)->get()->first();
    }

    /**
     * @param $profit
     */
    public static function saveUserScore($profit)
    {
        $currentUserScore = self::getUserScore();
        if (!empty($currentUserScore)) {
            if (strcasecmp($profit->name, Profites::PROFIT_MONEY) == 0) {
                $currentScore = self::find($currentUserScore->id);
                $currentScore->money += $profit->bounds;
                $currentScore->user_id = Auth::user()->id;
                $currentScore->save();
            } elseif (strcasecmp($profit->name, Profites::PROFIT_BONUS) == 0) {
                $currentScore = self::find($currentUserScore->id);
                $currentScore->bonus += $profit->bounds;
                $currentScore->user_id = Auth::user()->id;
                $currentScore->save();
            } elseif (strcasecmp($profit->name, Profites::PROFIT_SURPRISE) == 0) {
                UsersSurprise::create(['user_id' => Auth::user()->id, 'surprise_id' => $profit->bounds]);
            }
        } else {
            if (strcasecmp($profit->name, Profites::PROFIT_MONEY) == 0) {
                $currentScore = new UserScore();
                $currentScore->money = $profit->bounds;
                $currentScore->user_id = Auth::user()->id;
                $currentScore->save();
            } elseif (strcasecmp($profit->name, Profites::PROFIT_BONUS) == 0) {
                $currentScore = new UserScore();
                $currentScore->bonus = $profit->bounds;
                $currentScore->user_id = Auth::user()->id;
                $currentScore->save();
            } elseif (strcasecmp($profit->name, Profites::PROFIT_SURPRISE) == 0) {
                $userIdsSurprise = UsersSurprise::getUserSurpriseIds();
                UsersSurprise::create(['user_id' => Auth::user()->id, 'surprise_id' => $profit->bounds]);
            }
        }

    }
}
