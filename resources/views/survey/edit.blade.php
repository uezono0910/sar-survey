<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケートフォーム編集
      </h2>
  </x-slot>
  {{-- @if (session('message'))
    <div>
      {{ session('message') }}
    </div>
  @endif --}}
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="POST" action="{{ route('survey.update', $survey) }}">
      @method('PUT')
      @csrf
      <div class="w-full flex flex-col my-3">
        <label class="mt-4 mb-2">タイトル</label>
        <input type="text" name="title" value="{{ old('title', $survey->title) }}" />
      </div>
      <div class="w-64 flex flex-col my-3">
        <label class="mt-4 mb-2">日付</label>
        <input name="date" type="date" value="{{ old('date', $survey->date) }}" />
      </div>
      <div class="flex flex-col my-3">
        <label class="font-somibold mt-4 mb-2">備考</label>
        <textarea name="note" class="min-h-11">{{ old('note', $survey->note) }}</textarea>
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

<script>
// input要素にイベントのリスナーを追加
function setupInputListener(inputElement) {
  let inputValue = inputElement.value;
  inputElement.addEventListener('input', function() {
    // 入力が変更されるたびに実行される処理
    inputValue = inputElement.value;
    if (inputValue == "") {
      inputValue = 0;
    }
  });
}

// 順番の数値を増やす
function getCountUp($countUp){
  let inputElement = document.getElementById('order');
  let inputValue = Number(inputElement.value);
  inputValue = inputValue + 1;
  document.getElementById( "order" ).value = inputValue ;
}

// 順番の数値を減らす
function getCountDown($countDown){
  let inputElement = document.getElementById('order');
  let inputValue = Number(inputElement.value);
  if (inputValue > 1) {
    inputValue = inputValue - 1;
    document.getElementById( "order" ).value = inputValue ;
  }
}
</script>