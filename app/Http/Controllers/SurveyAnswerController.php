<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\SurveyAnswer;
use App\Models\Survey;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth;

class SurveyAnswerController extends Controller
{
    public function index() {
        // SurveyAnswerデータをすべて取得
        // $surveyanswers = surveyanswer::all();
        $surveyanswers = SurveyAnswer::paginate(10);
        return view('surveyanswer.index', compact('surveyanswers'));
    }

    public function show (SurveyAnswer $surveyanswer) {
        return view('surveyanswer.show', compact('surveyanswer'));
    }

    public function create() {
        $query = Survey::query();
        $surveys = $query->get();

        return view('surveyanswer.create')->with(['surveys' => $surveys]);
    }

    public function store(Request $request, SurveyAnswer $surveyanswer) {
        \Log::debug("store1");

        // $validated = $request->validate([
        //     'answer' => 'required|max:20',
        //     'surveys_id' => 'required|max:400',
        // ]);

        $request['title'];

        $request->title;

        \Log::debug("store3");

        // surveyのidをすべて取得
        $query = Survey::query();
        $surveys = $query->get();

        // surveyanswerのformの値をすべて取得
        $userId = auth()->id();
        foreach($surveys as $survey) {
            $key = "survey_" . $survey->id;
            $value = $request[$key];
            $surveyAnswerModel = new SurveyAnswer();
            $surveyAnswerModel->answer = $value;
            $surveyAnswerModel->surveys_id = $survey->id;
            $surveyAnswerModel->user_id = $userId;
            $surveyAnswerModel->save();
        }

        return view('surveyanswer.edit', compact('surveyanswer'))->with('message', '保存しました');
    }

    public function edit(SurveyAnswer $surveyanswer) {
        return view('surveyanswer.edit', compact('surveyanswer'));
    }

    public function update(Request $request, SurveyAnswer $surveyanswer) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

    $validated['user_id'] = auth()->id();
        $surveyanswer->update($validated);
        // $request->session()->flash('message', '更新しました');
        // return back();
        $request->session()->flash('message', '更新しました');
        return redirect()->route('surveyanswer.show', compact('surveyanswer'));
    }

    public function destroy(Request $request, SurveyAnswer $surveyanswer) {
        $surveyanswer->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('surveyanswer.index');
    }
}
