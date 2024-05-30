<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SurveyItem extends Model
{
    use SoftDeletes;
    protected $table = 'survey_items';
    protected $fillable = [
        'state',
        'content',
        'type',
        'choices',
        'order',
    ];

    public function getStateAttribute($value)
    {
        return $value == 0 ? 'public' : 'private';
    }

    public function getTypeAttribute($value)
    {
        // カラムtypeの数値を名前をつけて文字列に変換
        switch ($value) {
            case 1:
                return "テキストボックス";
            case 2:
                return "テキストエリア";
            case 3:
                return "セレクトボックス";
            case 4:
                return "ラジオボタン";
            case 5:
                return "チェックボックス";
            default:
                return $value;
        }
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = $value == 'public' ? '0' : '1';
    }
}
