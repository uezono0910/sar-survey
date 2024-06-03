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
        $surveyAnswersCount = surveyanswer::count();
        return view('survey.index', compact('surveys', 'surveyItemsCount', 'surveyAnswersCount'));
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
        // insert
        $survey = Survey::create($request->all());

        // 公開しているアンケート項目を取得
        $surveyItems = SurveyItem::where('state', 'public')->get();

        // insert
        foreach ($surveyItems as $surveyItem) {
            SurveyDetail::create([
                'survey_id' => $survey->id,
                'survey_item_id' => $surveyItem->id,
                'state' => $surveyItem->state,
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
