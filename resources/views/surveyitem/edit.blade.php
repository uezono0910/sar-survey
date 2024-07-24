<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート項目編集
      </h2>
  </x-slot>
  {{-- @if (session('message'))
    <div>
      {{ session('message') }}
    </div>
  @endif --}}
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="POST" action="{{ route('surveyitem.update', $surveyitem) }}">
      @method('PUT')
      @csrf
      <div class="w-full flex flex-col">
        <label for="content" class="font-somibold mt-4 mb-2">質問内容</label>
        <input type="text" name="content" value="{{ old('content', $surveyitem->content) }}">
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="type" class="font-somibold mt-4 mb-2">フォームタイプ</label>
        <select class="w-80" name="type">
          <option value="テキストボックス" {{ $surveyitem->type == 'テキストボックス' ? 'selected' : '' }}>テキストボックス</option>
          <option value="テキストエリア" {{ $surveyitem->type == 'テキストエリア' ? 'selected' : '' }}>テキストエリア</option>
          <option value="セレクトボックス" {{ $surveyitem->type == 'セレクトボックス' ? 'selected' : '' }}>セレクトボックス</option>
          <option value="ラジオボタン" {{ $surveyitem->type == 'ラジオボタン' ? 'selected' : '' }}>ラジオボタン</option>
          <option value="チェックボックス" {{ $surveyitem->type == 'チェックボックス' ? 'selected' : '' }}>チェックボックス</option>
        </select>
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="choices" class="font-somibold mt-4 mb-2">複数選択肢を設定する場合は、カンマ区切りで選択肢を記入</label>
        <textarea name="choices" class="min-h-11">{{ old('choices', $surveyitem->choices) }}</textarea>
      </div>
      <div class="flex">
        <x-primary-button class="mt-8 mr-8">
          <a class="m-auto" href="{{ route('surveyitem.index') }}">一覧</a>
        </x-primary-button>
        <x-primary-button class="mt-8">
          編集する
        </x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>

