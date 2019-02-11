<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profites extends Model
{
    const PROFIT_MONEY = 'money';
    const PROFIT_BONUS = 'bonus';
    const PROFIT_SURPRISE = 'surprise';

    /**
     * @var string $table
     */
    protected $table = 'profites';

    /**
     * @var bool $timestamps
     */
    public $timestamps = true;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'name',
    ];
}
