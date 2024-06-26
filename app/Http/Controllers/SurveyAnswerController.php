<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\Survey;
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
        // Surveyデータをすべて取得
        $surveys = survey::all();
        Log::debug($surveys);
        $surveyanswers = surveyanswer::all()->sortByDesc('updated_at');
        $surveyanswerdetails = surveyanswer::query()
            ->join('survey_answer_details', 'survey_answers.id', '=', 'survey_answer_details.survey_answer_id')
            ->get();
        Log::debug($surveyanswerdetails);

        // return DB::table('survey_answers')
        //     ->join('survey_answers' as 'survey_answer', function($join) {
        //         $join->on('survey_answer_details.survey_answer_id', '=', 'survey_answers.id');
        //     })
        //     ->get();

        // dd($surveyanswerdetails);
        Gate::authorize('auth');
        // アンケート一覧にデータを渡して画面表示
        return view('surveyanswer.index', compact('surveys', 'surveyanswers', 'surveyanswerdetails'));
    }

    public function show (SurveyAnswer $surveyanswer) {
        return view('surveyanswer.show', compact('surveyanswers'));
    }

    public function create() {
        $surveys = survey::orderBy('order', 'asc')->get();
        Log::debug($surveys);
        return view('surveyanswer.create', compact('surveys'));
    }

    public function store(Request $request, SurveyAnswer $surveyanswer) {
        // dd($request->all());
        $surveyAnswerModel = new SurveyAnswer();
        $surveyAnswerModel->save();

        // dd($request->all());
        // requestからキーを取得し代入
        $keys = array_keys($request->all());
        //　キーの数だけループさせる
        // #keys = ['_token','servey_1','servey_2','servey_3']
        foreach ($keys as $key) {
            // dd($key);
            // requestのキーを1つ取得
            // キーに"survey_"が存在するかチェック
            // 例：survey_1
            $temp = strstr($key, 'survey_');
            if ($temp !== false) {
                // dd($temp);
                // キーに"survey_"が存在する場合
                // 'survey_'の以降の文字を取得してint型に変更
                // survey_1 => 1
                $surveyId =intval(mb_substr($temp, 7));
                // 回答用の変数（文字列）を作成
                $answer = "";
                // requestの値を取得
                $temp_answer = $request[$key];
                // 値が配列かチェック
                if (!is_array($temp_answer)) {
                    // dd($temp_answer);
                    // 配列でない場合
                    // 値を文字列として回答用の変数に代入
                    $answer = $temp_answer;
                } else {
                    // 配列（回答が複数選択）の場合
                    // dd($temp_answer);
                    // foreach文を用いて、indexと要素を取り出す
                    $mult_answer = "";
                    foreach ($temp_answer as $index => $value) {
                        // dd($value);
                        // 配列から1つ取得
                        // 配列の要素数を取得
                        $count = count($temp_answer) - 1;
                        // dd($count);
                        if ($count !== $index){
                            // 配列の最後の要素でない場合
                            // dd($index);
                            // 文字列に追加
                            $mult_answer .= $value. ",";
                        } else {
                            // 配列の最後の要素の場合
                            // 文字列に追加
                            $mult_answer .= $value;
                            // dd($mult_answer);
                            // return $mult_answer;
                            $answer = $mult_answer;
                        }
                    }
                }
                // dd($temp);

                $surveyAnswerDetailModel = new SurveyAnswerDetail();
                $surveyAnswerDetailModel->answer = $answer;
                $surveyAnswerDetailModel->survey_id = $surveyId;
                $surveyAnswerDetailModel->survey_answer_id = $surveyAnswerModel->id;
                $surveyAnswerDetailModel->save();
            }
        }

        // キーと値をDBに入れる
        // foreach($surveyAnswerRequest as $surveyId => $answer){
        //     // Modelをインスタンス化
        //     $surveyAnswerDetailModel = new SurveyAnswerDetail();
        //     $surveyAnswerDetailModel->survey_id = $surveyId;
        //     $surveyAnswerDetailModel->answer = $answer;
        //     $surveyAnswerDetailModel->survey_answer_id = $surveyAnswerModel->id;
        //     // insert
        //     $surveyAnswerDetailModel->fill($request->all())->save();
        // }

        // 完了画面にリダイレクト
        return view('surveyanswer.complete');
    }

    public function edit(SurveyAnswer $surveyanswer) {
        return view('surveyanswer.edit', compact('surveyanswer'));
    }

    public function update(Request $request, SurveyAnswer $surveyanswer) {
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

    public function destroy(Request $request, SurveyAnswer $surveyanswer) {
        // $surveyanswer->delete();
        // $request->session()->flash('message', '削除しました');
        // return redirect()->route('surveyanswer.index');
    }
}
