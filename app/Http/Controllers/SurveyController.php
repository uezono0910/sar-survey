<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function index() {
        // Surveyデータを取得して降順にソート
        $surveys = survey::all()->sortByDesc('updated_at');
        // dd($surveys);
        return view('survey.index', compact('surveys'));
    }

    public function show (Survey $survey) {
        return view('survey.show', compact('survey'));
    }

    public function create() {
        return view('survey.create');
    }

    public function store(Request $request, Survey $survey) {
        // $validated = $request->validate([
        //     'title' => 'required|max:20',
        //     'body' => 'required|max:400',
        // ]);
        // $survey = Survey::create($validated);

        // Modelをインスタンス化
        $surveyModel = new Survey();

        // insert
        $surveyModel->fill($request->all())->save();

        // 一覧画面にリダイレクト
        return redirect()->route('survey.index');
        // ->with('message', '保存しました');
    }

    public function edit(Survey $survey) {
        return view('survey.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();
        $survey->update($validated);
        // $request->session()->flash('message', '更新しました');
        // return back();
        $request->session()->flash('message', '更新しました');
        return redirect()->route('survey.show', compact('survey'));
    }

    public function destroy(Request $request, Survey $survey) {
        $survey->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('survey.index');
    }
}
