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
        // dd($surveys);
        $surveyanswers = surveyanswer::all();
        // $surveyanswerdetails = surveyanswerdetail::all();
        $surveyanswerdetails = surveyanswer::query()
            ->join('survey_answer_details', 'survey_answers.id', '=', 'survey_answer_details.survey_answer_id')
            ->get();

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
        $surveys = survey::all();
        // dd($surveys);
        return view('surveyanswer.create', compact('surveys'));
    }

    public function store(Request $request, SurveyAnswer $surveyanswer) {
        $surveyAnswerModel = new SurveyAnswer();
        $surveyAnswerModel->save();

        // Requestを取得
        $surveyAnswerRequest = $request->all();
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
            $surveyAnswerDetailModel->survey_answer_id = $surveyAnswerModel->id;
            // insert
            $surveyAnswerDetailModel->fill($request->all())->save();
        }

        // 完了画面にリダイレクト
        return view('surveyanswer.complet');
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
