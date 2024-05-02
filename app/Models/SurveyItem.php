<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveyItem extends Model
{
    use HasFactory;
    protected $table = 'survey_items';
    protected $fillable = [
        'content',
        'type',
        'choices',
        'order',
    ];
}
