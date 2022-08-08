<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    /**
     * Explicitly setting table name
     */
    protected $table = 'sms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [  
        'website_id', 
        'country_id', 
        'user_id',
        'status',
        'message',
        'number_id',
        'received',
    ];

    /**
     * An sms may belong to a website
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
