<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = [
        'constituency_title',
        'affiliation_id'
    ];

    public function unioncouncil()
    {
        return $this->hasMany(UnionCouncil::class);
    }

    public function affiliation()
    {
        return $this->belongsTo(Affiliation::class);
    }
}
