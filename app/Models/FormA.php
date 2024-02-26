<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormA extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_a',
        'sg_id',
        'sg_approval',
        'sg_comment',
        'sg_approval_date',
        'president_id',
        'president_approval',
        'president_comment',
        'president_approval_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
