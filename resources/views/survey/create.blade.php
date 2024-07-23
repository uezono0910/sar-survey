<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            アンケートフォーム登録
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-40 py-12">
        <form method="POST" action="{{ route('survey.store') }}">
            @csrf
            <div class="w-full flex flex-col my-3">
                <label class="mt-4 mb-2">タイトル</label>
                <input type="text" name="title" value="{{ old('title') }}" />
            </div>
            <div class="w-64 flex flex-col my-3">
                <label class="mt-4 mb-2">日付</label>
                <input name="date" type="date" value="{{ old('date') }}" />
            </div>
            <div class="w-64 flex flex-col my-3">
                <label class="mt-4 mb-2">アンケート項目</label>
                <!-- Button to trigger modal -->
                <button type="button" id="openModalButton" class="bg-blue-700 text-white px-4 py-2 rounded">アンケート項目を選択</button>
                <div id="surveyItemsContainer"></div>
            </div>
            <div class="flex flex-col my-3">
                <label class="font-somibold mt-4 mb-2">備考</label>
                <textarea name="note" class="min-h-11">{{ old('note') }}</textarea>
            </div>
            <div>
                <x-primary-button class="mt-8">
                    登録する
                </x-primary-button>
            </div>
        </form>
    </div>
    <!-- Modal -->
    @include('components.surveydetail', ['surveyItems' => $surveyItems])
</x-app-layout>

<script>
  document.getElementById('openModalButton').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('myModal').classList.remove('hidden');

    // 編集時に選択済みのデータをチェック
    const selectedItems = @json($selectedItems ?? []);
    selectedItems.forEach(item => {
      const checkbox = document.querySelector(`input[name="surveyItems[]"][value="${item.id}"]`);
      if (checkbox) {
        checkbox.checked = true;
        const orderInput = document.querySelector(`input[name="order[${item.id}]"]`);
        if (orderInput) {
          orderInput.value = item.order;
        }
      }
    });
  });

  document.getElementById('closeModalButton').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('myModal').classList.add('hidden');
  });

  document.getElementById('saveSurveyItemsButton').addEventListener('click', function(event) {
    event.preventDefault();
    const checkboxes = document.querySelectorAll('input[name="surveyItems[]"]:checked');
    const surveyItemsContainer = document.getElementById('surveyItemsContainer');
    surveyItemsContainer.innerHTML = '';  // 既存の項目をクリア
    Array.from(checkboxes).forEach(cb => {
      const id = cb.value;
      const orderInput = document.querySelector(`input[name="order[${id}]"]`);
      const order = orderInput ? orderInput.value : '';

      // hiddenフィールドを追加して選択されたアンケート項目のIDと順序を格納
      const hiddenInputId = document.createElement('input');
      hiddenInputId.type = 'hidden';
      hiddenInputId.name = `items[${id}][id]`;
      hiddenInputId.value = id;

      const hiddenInputOrder = document.createElement('input');
      hiddenInputOrder.type = 'hidden';
      hiddenInputOrder.name = `items[${id}][order]`;
      hiddenInputOrder.value = order;

      surveyItemsContainer.appendChild(hiddenInputId);
      surveyItemsContainer.appendChild(hiddenInputOrder);
    });
    document.getElementById('myModal').classList.add('hidden');
  });
</script>
