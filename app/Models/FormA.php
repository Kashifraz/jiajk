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
        'dpd_id',
        'dpd_approval',
        'dpd_comment',
        'dpd_approval_date',
        'sg_id',
        'sg_approval',
        'sg_comment',
        'sg_approval_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
