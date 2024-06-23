<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'affiliation_title',
        'region'
    ];
    

    public function constituency()
    {
        return $this->hasMany(Constituency::class);
    }
}
