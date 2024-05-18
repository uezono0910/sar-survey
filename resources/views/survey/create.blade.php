<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート登録
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="POST" action="{{ route('surveyitem.index') }}">
      @csrf
      <div class="w-full flex flex-col py-3">
        <label for="type" class="font-somibold mt-4 mb-2"></label>
        <select class="w-80" name="type">
          @foreach($surveyItems as $surveyItem)
            <option value="{{ $surveyItem->id }}">{{ $surveyItem->content }}</option>
        </select>
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="choices" class="font-somibold mt-4 mb-2">複数選択肢を設定する場合は、カンマ区切りで選択肢を記入</label>
        <input type="text" name="choices" cols="20" wrap="soft" class="border border-gray-500"/>
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
function addForm() {
  $('#addButton').click(function(){
    var tr_form = '' +
    '<tr>' +
      '<td><input type="text" name="text_1[]"></td>' +
      '<td><input type="text" name="text_2[]"></td>' +
    '</tr>';
    $(tr_form).appendTo($('table > tbody'));
  });
}

// フォーム要素を取得
let inputElement = document.getElementById('order');
let inputValue = inputElement.value;
if (inputValue == "") {
  inputValue = 0;
}
// input要素にイベントのリスナーを追加
function setupInputListener(inputElement) {
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
