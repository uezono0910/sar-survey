<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\Survey;
use App\Models\SurveyItem;
use App\Models\SurveyDetail;
use App\Models\SurveyAnswer;
use App\Models\SurveyAnswerDetail;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth;
use Carbon\Carbon;

class SurveyAnswerController extends Controller
{
    public function index() {
        $surveys = Survey::all();
        $surveyItems = SurveyItem::all();
        $surveyAnswers = SurveyAnswer::all()->sortByDesc('updated_at');
        $surveyAnswerDetails = SurveyAnswerDetail::query()
            ->join('survey_details', 'survey_answer_details.survey_detail_id', '=', 'survey_details.id')
            ->get();

        Gate::authorize('auth');
        // アンケート一覧にデータを渡して画面表示
        return view('surveyanswer.index', compact('surveys', 'surveyItems', 'surveyAnswers', 'surveyAnswerDetails'));
    }

    public function show (SurveyAnswer $surveyAnswer) {
        return view('surveyanswer.show', compact('surveyAnswers', 'survey'));
    }

    public function create() {
        $survey = Survey::all();
        $surveyDetails = SurveyDetail::all();
        return view('surveyanswer.create', compact('surveyDetails', 'survey'));
    }

    public function answer(Survey $survey) {
        $surveyDetails = SurveyDetail::where('survey_id', $survey->id)->get();
        return view('surveyanswer.create', compact('survey', 'surveyDetails'));
    }

    public function store(Request $request, SurveyAnswer $surveyAnswer, Survey $survey) {
        $surveyAnswerModel = SurveyAnswer::create([
            'survey_id' => $survey['id'],
        ]);

        // requestからキーを取得し代入
        $keys = array_keys($request->all());
        //　キーの数だけループさせる
        // #keys = ['_token','servey_1','servey_2','servey_3']
        foreach ($keys as $key) {
            // requestのキーを1つ取得
            // キーに"survey_"が存在するかチェック
            // 例：survey_1
            $temp = strstr($key, 'surveyDetail_');
            if ($temp !== false) {
                // キーに"survey_"が存在する場合
                // 'survey_'の以降の文字を取得してint型に変更
                // survey_1 => 1
                $surveyDetailId = intval(mb_substr($temp, 13));
                // 回答用の変数（文字列）を作成
                $answer = "";
                // requestの値を取得
                $temp_answer = $request[$key];
                // 値が配列かチェック
                if (!is_array($temp_answer)) {
                    // 配列でない場合
                    // 値を文字列として回答用の変数に代入
                    $answer = $temp_answer;
                } else {
                    // 配列（回答が複数選択）の場合
                    // foreach文を用いて、indexと要素を取り出す
                    $mult_answer = "";
                    foreach ($temp_answer as $index => $value) {
                        // 配列から1つ取得
                        // 配列の要素数を取得
                        $count = count($temp_answer) - 1;
                        if ($count !== $index){
                            // 配列の最後の要素でない場合
                            // 文字列に追加
                            $mult_answer .= $value. ",";
                        } else {
                            // 配列の最後の要素の場合
                            // 文字列に追加
                            $mult_answer .= $value;
                            $answer = $mult_answer;
                        }
                    }
                }

                $surveyAnswerDetailModel = new SurveyAnswerDetail();
                $surveyAnswerDetailModel->answer = $answer;
                $surveyAnswerDetailModel->survey_detail_id = $surveyDetailId;
                $surveyAnswerDetailModel->survey_answer_id = $surveyAnswerModel->id;
                $surveyAnswerDetailModel->save();
            }
        }

        // 完了画面にリダイレクト
        return view('surveyanswer.complete');
    }

    public function edit(SurveyAnswer $surveyAnswer) {
        return view('surveyanswer.edit', compact('surveyanswer'));
    }

    public function update(Request $request, SurveyAnswer $surveyAnswer) {
    //     $validated = $request->validate([
    //         'title' => 'required|max:20',
    //         'body' => 'required|max:400',
    //     ]);

    // $validated['user_id'] = auth()->id();
    //     $surveyanswer->update($validated);
    //     // $request->session()->flash('message', '更新しました');
    //     // return back();
    //     $request->session()->flash('message', '更新しました');
        // return redirect()->route('surveyanswer.show', compact('surveyanswer'));
    }

    public function destroy(Request $request, SurveyAnswer $surveyAnswer) {
        // $surveyanswer->delete();
        // $request->session()->flash('message', '削除しました');
        // return redirect()->route('surveyanswer.index');
    }

    // public function answer(Request $request, int $id) {

    //     $query = SurveyAnswer::query();
    //     $surveyItems = $query->where([
    //         ['id','=',$id]
    //     ])->get();

    //     $surveyAnswerModel = new SurveyAnswer()

    //     $surveyItems = survey::orderBy('order', 'asc')->get();
    //     return view('surveyanswer.create', compact('surveys'));
    // }
}
