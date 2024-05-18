<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\survey;
use App\Models\SurveyAnswer;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;
use App\Enum\ESurveyType;

class SurveyController extends Controller
{
    public function index() {
        // surveyデータを取得して降順にソート
        $surveys = Survey::orderBy('order', 'asc')->get();
        return view('survey.index', compact('surveys'));
    }

    public function show (Survey $survey) {
        return view('survey.show', compact('survey'));
    }

    public function create() {
        return view('survey.create');
    }

    public function store(Request $request, Survey $survey) {
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
