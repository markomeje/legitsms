<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

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
