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

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = $value == 'public' ? '0' : '1';
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

    public function setTypeAttribute($value)
    {
        switch ($value) {
            case "テキストボックス":
                $this->attributes['type'] = 1;
                break;
            case "テキストエリア":
                $this->attributes['type'] = 2;
                break;
            case "セレクトボックス":
                $this->attributes['type'] = 3;
                break;
            case "ラジオボタン":
                $this->attributes['type'] = 4;
                break;
            case "チェックボックス":
                $this->attributes['type'] = 5;
                break;
            default:
                $this->attributes['type'] = $value;
                break;
        }
    }
}
