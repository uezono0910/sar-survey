<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Survey;
use App\Models\SurveyItem;
use App\Models\SurveyDetail;
use App\Models\SurveyAnswer;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;
use App\Enum\ESurveyType;

class SurveyController extends Controller
{
    public function index() {
        // surveyデータを取得して降順にソート
        $surveys = Survey::all()->sortByDesc('updated_at');
        $surveyItemsCount = SurveyItem::count();
        $surveyAnswersCount = SurveyAnswer::count();
        // 現在のURLを取得
        $currentUrl = url()->current();
        return view('survey.index', compact('surveys', 'surveyItemsCount', 'surveyAnswersCount', 'currentUrl'));
    }

    public function show (Survey $survey) {
        // surveyデータを取得して降順にソート
        $surveys = Survey::all()
        ->where('date', '')
        ->get();
    }

    public function create() {
        return view('survey.create');
    }

    public function store(Request $request, Survey $survey) {

        //  アンケートフォームのURLを作成
        // surveyテーブルの最後のidを取得
        $lastRecord = Survey::orderBy('id', 'desc')->first();
        // dd($lastRecord);
        if ($lastRecord == null) {
            $lastRecordId = 0;
        } else {
            $lastRecordId = $lastRecord->id;
        }
        $urlId = $lastRecordId + 1;
        $surveyUrl = "survey/{$urlId}/answer";

        // insert
        $survey = new Survey($request->all());
        $survey->url = $surveyUrl;
        $survey->save();

        // 公開しているアンケート項目を取得
        $surveyItems = SurveyItem::all();

        // insert
        foreach ($surveyItems as $surveyItem) {
            SurveyDetail::create([
                'survey_id' => $survey->id,
                'survey_item_id' => $surveyItem->id,
                'content' => $surveyItem->content,
                'type' => $surveyItem->type,
                'order' => $surveyItem->order,
                'choices' => $surveyItem->choices,
            ]);
        }
        // 一覧画面にリダイレクト
        return redirect()->route('survey.index');
        // ->with('message', '保存しました');
    }

    public function edit(Survey $survey) {
        return view('survey.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey) {

        $survey->update($request->all());
        // // $request->session()->flash('message', '更新しました');
        return redirect()->route('survey.index');
    }

    public function destroy(Request $request, Survey $survey) {
        $survey->delete();
        // $request->session()->flash('message', '削除しました');

        return redirect()->route('survey.index');
    }
}
