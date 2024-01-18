<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth;
use Carbon\Carbon;

class SurveyAnswerController extends Controller
{
    public function index() {
        // SurveyAnswerデータをすべて取得して降順にソート
        $surveyanswers = surveyanswer::all()->sortByDesc('answered_at');
        // dd($surveyanswers);

        Gate::authorize('auth');
        // アンケート一覧にデータを渡して画面表示
        return view('surveyanswer.index', compact('surveyanswers'));
    }

    public function show (SurveyAnswer $surveyanswer) {
        return view('surveyanswer.show', compact('surveyanswers'));
    }

    public function create() {
        $surveys = survey::all();
        return view('surveyanswer.create', compact('surveys'));
    }

    public function store(Request $request, SurveyAnswer $surveyanswer) {

        // $validated = $request->validate([
        //     'answer' => 'required|max:20',
        //     'surveys_id' => 'required|max:400',
        // ]);

        // $request['title'];
        // $request->title;

        // surveyのidをすべて取得
        // $query = Survey::query();
        // $surveys = $query->get();

        // チェックBOXをカンマ区切りで文字列に変換
        $answerText09 = implode(",", $request->answer_text_09);

        // 要素をrequestに追加
        $request->merge(['answer_text_09' => $answerText09]);

        // dd($answerText09);

        // 現在の日時を取得
        $now = Carbon::now();
        // dd($now);

        // 現在の日時を変換
        $answeredAt = $now->format('Y-m-d H:i:s');
        // dd($answeredAt);

        // 要素をrequestに追加
        $request->merge(['answered_at' => $answeredAt]);
        // dd($request);

        // Modelをインスタンス化
        $surveyAnswerModel = new SurveyAnswer();

        // insert
        $surveyAnswerModel->fill($request->all())->save();

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
