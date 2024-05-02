<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート編集
      </h2>
  </x-slot>
  {{-- @if (session('message'))
    <div>
      {{ session('message') }}
    </div>
  @endif --}}
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="POST" action="{{ route('surveyitem.update', $surveyItem) }}">
      @method('PUT')
      @csrf
      <div class="w-full flex flex-col">
        <label for="content" class="font-somibold mt-4 mb-2">質問内容</label>
        <input type="text" name="content" value="{{ old('content', $surveyItem->content) }}">
      </div>

      <div class="w-full flex flex-col py-3">
        <label for="type" class="font-somibold mt-4 mb-2">フォームタイプ</label>
        <select class="w-80" name="type">
          <option value="1" {{ $surveyItem->type == '1' ? 'selected' : '' }}>テキストボックス</option>
          <option value="2" {{ $surveyItem->type == '2' ? 'selected' : '' }}>テキストエリア</option>
          <option value="3" {{ $surveyItem->type == '3' ? 'selected' : '' }}>セレクトボックス</option>
          <option value="4" {{ $surveyItem->type == '4' ? 'selected' : '' }}>ラジオボタン</option>
          <option value="5" {{ $surveyItem->type == '5' ? 'selected' : '' }}>チェックボックス</option>
        </select>
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="choices" class="font-somibold mt-4 mb-2">複数選択肢を設定する場合は、カンマ区切りで選択肢を記入</label>
        <input type="text" name="choices" cols="20" wrap="soft" class="border border-gray-500" value="{{ old('choices', $surveyItem->choices) }}"/>
      </div>
      <div class="w-64 flex flex-col">
        <label for="order" class="font-somibold mt-4 mb-2">表示順</label>
        <div class="flex">
          <input id="order" type="text" name="order" />
          <div class="flex flex-col">
            <div id="countUp" onclick="getCountUp()" class="ml-1 mb-1 text-xs leading-none text-center cursor-pointer p-0.5 hover:bg-gray-300 rounded border border-gray-400">
            △
            </div>
            <div id="countDown" onclick="getCountDown()" class="ml-1 text-xs leading-none text-cente cursor-pointer p-0.5 hover:bg-gray-300 rounded border border-gray-400">
            ▽
            </div>
          </div>
        </div>
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