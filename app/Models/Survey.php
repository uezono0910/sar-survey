<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys';
    protected $fillable = [
        'content',
        'form_type',
        'choices',
        // 'sort_order',
    ];
}
