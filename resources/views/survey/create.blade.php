<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケートフォーム登録
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto sm:px-40 py-12">
    <form method="POST" action="{{ route('survey.index') }}">
      @csrf
      <div class="w-full flex flex-col my-3">
        <label class="mt-4 mb-2">タイトル</label>
        <input type="text" name="title" />
      </div>
      <div class="w-64 flex flex-col my-3">
        <label class="mt-4 mb-2">日付</label>
        <input name="date" type="date" />
      </div>
      <div class="flex flex-col my-3">
        <label class="font-somibold mt-4 mb-2">備考</label>
        <textarea name="note" class="min-h-11"></textarea>
      </div>
      <div>
        <x-primary-button class="mt-8">
          登録する
        </x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>

<script>

// フォーム要素を取得
let inputElement = document.getElementById('order');
let inputValue = inputElement.value;

// 表示順のフォームの値を取得
function setupInputListener(inputElement) {
  inputElement.addEventListener('input', function() {
    // 入力が変更されるたびに実行
    inputValue = inputElement.value;
    if (inputValue == "") {
      inputValue = 0;
    }
  });
}
// 順番の数値を増やす
function getCountUp($countUp){
  let inputValue = Number(inputElement.value);
  inputValue = inputValue + 1;
  document.getElementById( "order" ).value = inputValue ;
}

// 順番の数値を減らす
function getCountDown($countDown){
  let inputValue = Number(inputElement.value);
  if (inputValue > 1) {
    inputValue = inputValue - 1;
    document.getElementById( "order" ).value = inputValue ;
  }
}

</script>
