<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surprise extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'surprise';

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
