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
        // Log::debug($surveyItems);
        $surveyAnswersCount = surveyanswer::count();
        // Log::debug($surveyAnswers);
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
        // surveyModelをインスタンス化
        $surveyModel = new Survey();
        // insert
        $surveyModel->fill($request->all())->save();
        // insertしたsurveyテーブルのidを取得
        $surveyId = $surveyModel->id;
        // 公開しているアンケート項目のidを取得
        $surveyItemIds = SurveyItem::where('state', 'public')->pluck('id');
        foreach ($surveyItemIds as $id) {
            // surveyDetailModelをインスタンス化
            $surveyDetailModel = new SurveyDetail();
            $surveyDetailModel->survey_id = $surveyId;
            $surveyDetailModel->survey_item_id = $id;
            $surveyDetailModel->save();
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
