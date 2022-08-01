<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'deposited',
        'amount',
        'status',
        'user_id',
        'reference',
    ];

    /**
     * The statuses of any deposite transactions
     *
     * @var array<int, string>
     */
    public const STATUSES = [
        'initialized',
        'paid',
        'failed',
    ];

    /**
     * An deposit belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
