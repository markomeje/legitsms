<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'active',
        'code',
    ];

    /**
     * Status of each website
     */
    public const STATUS = [
        'active' => true, 
        'inactive' => false
    ];

    /**
     * A website has many verifications
     */
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }
}
