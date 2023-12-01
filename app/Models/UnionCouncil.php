<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnionCouncil extends Model
{
    use HasFactory;

    protected $fillable = [
        'union_council_title',
        'constituency_id'
    ];

    public function ward()
    {
        return $this->hasMany(Ward::class);
    }

    public function Constituency()
    {
        return $this->belongsTo(Constituency::class);
    }
}
