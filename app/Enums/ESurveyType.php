<?php

namespace App\Enums;

Enum ESurveyType: int
{
    case TEXTBOX = 0;       // 0:テキストボックス
    case TEXTAREA = 1;      // 1:テキストエリア
    case SELECTBOX = 2;     // 2:セレクトボックス
    case RADIOBUTTON = 3;   // 3:ラジオボタン
    case CHECKBOX = 4;      // 4:チェックボックス


    // 日本語を追加
    public function label(): string
    {
        return match($this)
        {
            Type::TEXTBOX => 'テキストボックス',
            Type::TEXTAREA => 'テキストエリア',
            Type::SELECTBOX => 'セレクトボックス',
            Type::RADIOBUTTON => 'ラジオボタン',
            Type::CHECKBOX => 'チェックボックス',
        };
    }
}
