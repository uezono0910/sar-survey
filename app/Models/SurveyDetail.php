<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyDetail extends Model
{
    protected $table = 'survey_details';
    protected $fillable = [
        'survey_id',
        'survey_item_id',
    ];
}
