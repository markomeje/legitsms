<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'token',
        'duration',
    ];
}
