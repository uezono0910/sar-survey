<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $table = 'survey_answers';
    protected $fillable = [
        'answered_at',
        'answer_text_01',
        'answer_text_02',
        'answer_text_03',
        'answer_text_04',
        'answer_text_05',
        'answer_text_06',
        'answer_text_07',
        'answer_text_08',
        'answer_text_09',
        'answer_text_10',
    ];
}
