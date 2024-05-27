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

        return view('surveyitem.index', compact('surveyItems'));
    }

    public function show (SurveyItem $surveyItem) {
        return view('surveyitem.show', compact('surveyItem'));
    }

    public function create() {
        return view('surveyitem.create');
    }

    public function store(Request $request, SurveyItem $surveyItem) {
        // 状態を変換
        $state = $request->input('state') === 'public' ? 0 : 1;
        Log::debug('Converted state value: ' . $state);

        // Modelをインスタンス化
        $surveyItemModel = new SurveyItem();

        // insert
        $surveyItemModel->fill($request->all());
        $surveyItemModel->state = $state;
        $surveyItemModel->save();

        // 一覧画面にリダイレクト
        return redirect()->route('surveyitem.index');
        // ->with('message', '保存しました');
    }

    public function edit(SurveyItem $surveyitem) {
        return view('surveyitem.edit', compact('surveyitem'));
    }

    public function update(Request $request, SurveyItem $surveyitem) {

        $surveyitem->update($request->all());
        // // $request->session()->flash('message', '更新しました');
        return redirect()->route('surveyitem.index');
    }

    public function destroy(Request $request, SurveyItem $surveyitem) {
        $surveyitem->delete();
        // $request->session()->flash('message', '削除しました');

        return redirect()->route('surveyitem.index');
    }
}
