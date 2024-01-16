<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Survey;
use GuzzleHttp\Psr7\Message;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function index() {
        // Surveyデータをすべて取得
        // $surveys = survey::all();
        $surveys = Survey::paginate(10);
        return view('survey.index', compact('surveys'));
    }

    public function show (Survey $survey) {
        return view('survey.show', compact('survey'));
    }

    public function create() {
        return view('survey.create');
    }

    public function store(Request $request, Survey $survey) {
        // Gate::authorize('test');
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $survey = Survey::create($validated);
        return view('survey.show', compact('survey'))->with('message', '保存しました');
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
