<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswerDetail extends Model
{
    use HasFactory;
    protected $table = 'survey_answer_details';
    protected $fillable = [
        'answer',
        'survey_id',
    ];
}
