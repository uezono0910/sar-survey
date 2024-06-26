<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート登録
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="POST" action="{{ route('survey.index') }}">
      @csrf
      <div class="w-full flex flex-col">
        <label for="content" class="font-somibold mt-4 mb-2">質問内容</label>
        <input type="text" name="content" />
      </div>

      <div class="w-full flex flex-col py-3">
        <label for="type" class="font-somibold mt-4 mb-2">フォームタイプ</label>
        <select class="w-80" name="type">
          <option value="1">テキストボックス</option>
          <option value="2">テキストエリア</option>
          <option value="3">セレクトボックス</option>
          <option value="4">ラジオボタン</option>
          <option value="5">チェックボックス</option>
        </select>
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="choices" class="font-somibold mt-4 mb-2">複数選択肢を設定する場合は、カンマ区切りで選択肢を記入</label>
        <input type="text" name="choices" cols="20" wrap="soft" class="border border-gray-500"/>
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
