<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\surveyItem;
use App\Models\SurveyAnswer;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;
use App\Enum\ESurveyType;

class SurveyItemController extends Controller
{
    public function index() {
        // surveyItemデータを取得して降順にソート
        $surveyItems = SurveyItem::orderBy('order', 'asc')->get();
        // カラムtypeの数値を名前をつけて文字列に変換
        foreach($surveyItems as $surveyItem){
            Log::debug($surveyItem);
            if ($surveyItem['type'] == "1") {
                $surveyItem['type'] = "テキストボックス";
                Log::debug($surveyItem['type']);
            } elseif($surveyItem['type'] == "2") {
                $surveyItem['type'] = "テキストエリア";
                Log::debug($surveyItem['type']);
            } elseif($surveyItem['type'] == "3") {
                $surveyItem['type'] = "セレクトボックス";
                Log::debug($surveyItem['type']);
            } elseif($surveyItem['type'] == "4") {
                $surveyItem['type'] = "ラジオボタン";
                Log::debug($surveyItem['type']);
            } elseif($surveyItem['type'] == "5") {
                $surveyItem['type'] = "チェックボックス";
                Log::debug($surveyItem['type']);
            }
        }

        return view('surveyitem.index', compact('surveyItems'));
    }

    public function show (SurveyItem $surveyItem) {
        return view('surveyitem.show', compact('surveyitem'));
    }

    public function create() {
        return view('surveyitem.create');
    }

    public function store(Request $request, SurveyItem $surveyItem) {
        // Modelをインスタンス化
        $surveyItemModel = new SurveyItem();

        // insert
        $surveyItemModel->fill($request->all())->save();

        // 一覧画面にリダイレクト
        return redirect()->route('surveyitem.index');
        // ->with('message', '保存しました');
    }

    public function edit(SurveyItem $surveyItem) {
        return view('surveyitem.edit', compact('surveyItem'));
    }

    public function update(Request $request, SurveyItem $surveyItem) {

        $surveyItem->update($request->all());
        // // $request->session()->flash('message', '更新しました');
        return redirect()->route('surveyitem.index');
    }

    public function destroy(Request $request, SurveyItem $surveyItem) {
        $surveyItem->delete();
        // $request->session()->flash('message', '削除しました');
        return redirect()->route('surveyitem.index');
    }
}
