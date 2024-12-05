<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $table = 'survey_answers';
    protected $fillable = [
        'id',
        'survey_id',
    ];

    public function survey_answer_details()
	{
		return $this->hasMany(SurveyAnswerDetail::class, 'survey_answer_id');
	}
}
