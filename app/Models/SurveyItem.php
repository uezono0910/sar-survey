<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class surveyItem extends Model
{
    use SoftDeletes;
    protected $table = 'survey_items';
    protected $fillable = [
        'content',
        'type',
        'choices',
        'order',
    ];
}
