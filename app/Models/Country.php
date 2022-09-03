<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'id_number',
    ];

    /**
     * A country has many verifications
     */
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

    /**
     * A country has many websites
     */
    public function websites()
    {
        return $this->hasMany(Website::class);
    }
}
