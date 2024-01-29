<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        // SurveyAnswerDetailデータをすべて取得して降順にソート
        $surveyanswerdetails = surveyanswerdetail::all()->sortByDesc('answered_at');
        // dd($surveyanswerdetails);

        Gate::authorize('auth');
        // アンケート一覧にデータを渡して画面表示
        return view('surveyanswer.index', compact('surveys', 'surveyanswerdetails'));
    }

    public function show (SurveyAnswer $surveyanswer) {
        return view('surveyanswer.show', compact('surveyanswers'));
    }

    public function create() {
        $surveys = survey::all();
        // dd($surveys);
        return view('surveyanswer.create', compact('surveys'));
    }

    public function store(Request $request, SurveyAnswer $surveyanswer) {
        // dd($request);
        // Requestを取得
        $surveyAnswerRequest = $request->all();
        // dd($surveyAnswerRequest);
        // Requestのひとつめは不要のため削除
        unset($surveyAnswerRequest['_token']);
        // キーを取得
        $surveyIds = array_keys($surveyAnswerRequest);
        // キーと値をDBに入れる
        foreach($surveyAnswerRequest as $surveyId => $answer){
            // Modelをインスタンス化
            $surveyAnswerDetailModel = new SurveyAnswerDetail();
            $surveyAnswerDetailModel->survey_id = $surveyId;
            $surveyAnswerDetailModel->answer = $answer;
            // dd($surveyAnswerDetailModel);
            // insert
            $surveyAnswerDetailModel->fill($request->all())->save();
        }


        // キーの存在チェック
        // $surveys = survey::all();
        // foreach ($surveys as $survey) {
        //     dd($surveys);
        //     $surveyId = $survey->id;
        //     $answerKey = "answer_".$surveyId;
        //     $surveyKey = "survey_".$surveyId;
        //     if (isset($surveyAnswerRequest[$answerKey])) {
        //         // dd($key);
        //         if (isset($surveyAnswerRequest[$surveyKey])) {
        //             $surveyAnswerDetailModel = new SurveyAnswerDetail();
        //             // $surveyAnswerDetailModel->survey_id = $surveyId;
        //             // $surveyAnswerDetailModel->answer = $answer;
        //             // insert
        //             // $surveyAnswerDetailModel->fill($request->all())->save();
        //         }
        //     } else {
        //         $surveyId = $surveyId + 1;
        //         $answerKey = "answer_".$surveyId;
        //         dd($answerKey);
        //         $surveyKey = "survey_".$surveyId;
        //         $surveyAnswerDetailModel = new SurveyAnswerDetail();
        //         $surveyAnswerDetailModel->survey_id = $surveyId;
        //         $surveyAnswerDetailModel->answer = $answer;
        //     }


        // }
        // dd($surveyAnswerRequest);
        // if (isset($surveyAnswerRequest['answe_1'])) {
        //     echo $ary['answe_1'];
        // }


        // 完了画面にリダイレクト
        return view('surveyanswer.complet');
        // , compact('survey'))->with('message', '保存しました');
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
        return redirect()->route('surveyanswer.show', compact('surveyanswer'));
    }

    public function destroy(Request $request, SurveyAnswer $surveyanswer) {
        // $surveyanswer->delete();
        // $request->session()->flash('message', '削除しました');
        return redirect()->route('surveyanswer.index');
    }
}
