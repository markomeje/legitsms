<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
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
        'responded',
        'status',
    ];

    /**
     * A number may belong to a country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * An number belongs to a website
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
