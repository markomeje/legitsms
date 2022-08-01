<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'balance', 
        'ledger', 
        'user_id',
        'status',
    ];

    /**
     * An account belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
