<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-40 py-12">
    <form method="POST" action="{{ route('surveyanswer.store') }}">
      {{-- @foreach($surveys as $survey) --}}
      {{-- <div class="mt-8">
        <div class="w-full flex flex-col">
          <label for="body" class="font-somibold mt-4">{{ $survey->content }}</label>
          <x-input-error :messages="$errors->get('body')" class="mt-2" />
          <input type="text" name="survey_{{ $survey->id }}" />
        </div>
      </div> --}}
      {{-- @endforeach --}}
      @csrf
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_01" class="font-somibold mt-4 mb-2">本日の作業内容を教えてください。</label>
        <input type="text" name="answer_text_01" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_02" class="font-somibold mt-4 mb-2">本日のもくもく会の雰囲気はどうでしたか？</label>
        <input type="text" name="answer_text_02" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_03" class="font-somibold mt-4 mb-2">もくもく会に求めることがあれば教えてください。</label>
        <input type="text" name="answer_text_03" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_04" class="font-somibold mt-4 mb-2">またfreelance-villageのもくもく会に参加したいですか？</label>
        <input type="text" name="answer_text_04" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_05" class="font-somibold mt-4 mb-2">懇親会に参加する予定はありますか？</label>
        <input type="text" name="answer_text_05" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_06" class="font-somibold mt-4 mb-2">苦手な食べ物、飲み物、アレルギー等はありますか？</label>
        <input type="text" name="answer_text_06" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_07" class="font-somibold mt-4 mb-2">もくもく会に参加しようと思ったきっかけがあればを教えてください。</label>
        <input type="text" name="answer_text_07" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_08" class="font-somibold mt-4 mb-2">質問8</label>
        <input type="text" name="answer_text_08" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_09" class="font-somibold mt-4 mb-2">質問9</label>
        <input type="text" name="answer_text_09" />
      </div>
      <div class="w-full flex flex-col py-3">
        <label for="answer_text_10" class="font-somibold mt-4 mb-2">質問10</label>
        <input type="text" name="answer_text_10" />
      </div>

      <div>
        <x-primary-button class="mt-8">
          送信する
        </x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>
