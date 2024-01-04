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


    public static function nice_number($n)
    {
        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n >= 1000000000000) return round(($n / 1000000000000), 2) . ' trillion';
        elseif ($n >= 1000000000) return round(($n / 1000000000), 2) . ' billion';
        elseif ($n >= 1000000) return round(($n / 1000000), 2) . ' million';
        elseif ($n >= 1000) return round(($n / 1000), 2) . ' thousand';

        return number_format($n);
    }


    public function unioncouncil()
    {
        return $this->belongsTo(UnionCouncil::class);
    }
}
