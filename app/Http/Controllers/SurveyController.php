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
        $surveyDetails = SurveyDetail::all();
        $surveyAnswersCount = SurveyAnswer::count();
        // 各surveyのsurveyDetailをカウント
        $surveyDetailCounts = [];
        foreach ($surveys as $survey) {
            $surveyDetailCounts[$survey->id] = $surveyDetails->where('survey_id', $survey->id)->count();
        }
        // dd($surveyDetailCounts);
        // 現在のURLを取得
        $currentUrl = url()->current();
        return view('survey.index', compact('surveys', 'surveyDetails', 'surveyAnswersCount','surveyDetailCounts', 'currentUrl'));
    }

    public function show (Survey $survey) {
        // surveyデータを取得して降順にソート
        $surveys = Survey::all()
        ->where('date', '')
        ->get();
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
        // dd($request);
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
            $surveyItem = SurveyItem::where('id', $itemId)->first();

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
