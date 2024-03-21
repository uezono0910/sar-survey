<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート内容
      </h2>
  </x-slot>
  {{-- @if (session('message'))
    <div>
      {{ session('message') }}
    </div>
  @endif --}}
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="PUT" action="{{ route('survey.index', $survey) }}">
      @csrf
      <div class="w-full flex flex-col">
        <div class="font-somibold mt-4 mb-2 font-bold">質問内容</div>
        <div class="min-w-80">{{ $survey->content }}</div>
      </div>

      <div class="w-full flex flex-col py-3">
        <div for="type" class="font-somibold mt-4 mb-2 font-bold">フォームタイプ</div>
        <div class="min-w-80">{{ $survey->type }}</div>
      </div>
      <div class="w-full flex flex-col py-3">
        <div for="choices" class="font-somibold mt-4 mb-2 font-bold">複数選択肢を設定する場合は、カンマ区切りで選択肢を記入</div>
        <div class="">{{ $survey->choices }}</div>
      </div>
      <div>
        <x-primary-button class="mt-8 mr-4">
          一覧
        </x-primary-button>
        <x-primary-button class="mt-8">
          <a class="m-auto" href="{{ route('survey.edit', ['survey'=>$survey->id]) }}">編集する</a>
        </x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>