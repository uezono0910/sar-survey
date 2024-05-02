<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveyItems extends Model
{
    use HasFactory;
    protected $table = 'survey';
    protected $fillable = [
        'content',
        'type',
        'choices',
        'order',
    ];
}
