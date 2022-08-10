<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'website_id',
        'country_id',
        'user_id',
        'phone',
        'code',
        'status',
    ];

    /**
     * A VERIFICATION may belong to a country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * An VERIFICATION belongs to a website
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * An VERIFICATION belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
