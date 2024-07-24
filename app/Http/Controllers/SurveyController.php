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
        // 各surveyのsurveyDetailをカウント
        foreach ($surveys as $survey) {
            $surveyDetailsCount[$survey->id] = SurveyDetail::where('survey_id', $survey->id)->count();
        }
        // 各surveyのsurveyAnswersをカウント
        foreach ($surveys as $survey) {
            $surveyAnswersCount[$survey->id] = SurveyAnswer::where('survey_id', $survey->id)->count();
        }
        // 現在のURLを取得
        $currentUrl = url()->current();
        return view('survey.index', compact('surveys', 'surveyAnswersCount','surveyDetailsCount', 'currentUrl'));
    }

    public function show (Survey $survey) {
        $surveys = Survey::find($survey);
        $surveyDetails = SurveyDetail::where('survey_id', $surve->id)->get();
        // 現在のURLを取得
        $currentUrl = url()->current();
        return view('survey.index', compact('surveys', 'surveyDetails', 'surveyAnswersCount','surveyDetailCounts', 'currentUrl'));
    }

    public function create() {
        $surveyItems = SurveyItem::all();
        return view('survey.create', compact('surveyItems'));
    }

    public function store(Request $request, Survey $survey) {
        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'date' => 'required|date',
        //     'items' => 'required|string',  // itemsはJSON形式で送信されるためstringとする
        //     'note' => 'nullable|string',
        // ]);
        // アンケートフォームのURLを作成
        // surveyテーブルの最後のidを取得
        $lastRecordId = Survey::max('id') ?? 0;
        $urlId = $lastRecordId + 1;
        $surveyUrl = "survey/{$urlId}/answer";

        // insert
        $survey = new Survey($request->all());
        $survey->url = $surveyUrl;
        $survey->save();

        $items = $request->input('items', []);
        // itemのidを取得し配列に格納
        foreach ($items as $item) {
            $itemId = $item['id'];
            $order = $item['order'];
            $surveyItem = SurveyItem::find($itemId);

            // insert
            SurveyDetail::create([
                'survey_id' => $survey->id,
                'survey_item_id' => $surveyItem->id,
                'order' => $order,
                'content' => $surveyItem->content,
                'type' => $surveyItem->type,
                'choices' => $surveyItem->choices,
            ]);
        }

        // 一覧画面にリダイレクト
        return redirect()->route('survey.index')->with('message', '保存しました');
    }

    public function edit(Survey $survey) {
        $surveyItems = SurveyItem::all();
        $surveyDetails = SurveyDetail::where('survey_id', $survey->id)->get();
        $selectedItems = [];
        foreach ($surveyDetails as $surveyDetail) {
            $selectedItems[] = [
                'id' => $surveyDetail->survey_item_id,
                'order' => $surveyDetail->order,
            ];
        }

        return view('survey.edit', compact('survey', 'surveyItems', 'selectedItems'));
    }

    public function update(Request $request, Survey $survey) {

        $items = $request->input('items', []);
        // insert
        $survey->update($request->all());
        // 現在のSurveyDetailsを削除して、新しいデータで上書き
        SurveyDetail::where('survey_id', $survey->id)->delete();
        // itemのidを取得し配列に格納
        foreach ($items as $item) {
            $itemId = $item['id'];
            $order = $item['order'];
            $surveyItem = SurveyItem::find($itemId);
            SurveyDetail::create([
                'survey_id' => $survey->id,
                'survey_item_id' => $surveyItem->id,
                'order' => $order,
                'content' => $surveyItem->content,
                'type' => $surveyItem->type,
                'choices' => $surveyItem->choices,
            ]);
        }
        return redirect()->route('survey.index');
    }

    public function destroy(Request $request, Survey $survey) {
        $survey->delete();
        // $request->session()->flash('message', '削除しました');

        return redirect()->route('survey.index');
    }
}
