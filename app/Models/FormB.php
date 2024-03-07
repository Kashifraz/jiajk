<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormB extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_b',
        'dpd_id',
        'dpd_approval',
        'dpd_comment',
        'dpd_approval_date',
        'sg_id',
        'sg_approval',
        'sg_comment',
        'sg_approval_date',
        'pd_id',
        'pd_approval',
        'pd_comment',
        'pd_approval_date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
