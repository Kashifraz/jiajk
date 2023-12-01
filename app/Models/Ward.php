<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_title',
        'union_council_id'
    ];

    public function unioncouncil()
    {
        return $this->belongsTo(UnionCouncil::class);
    }
}
