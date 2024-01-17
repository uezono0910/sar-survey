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

      <div class="w-full flex-col py-3">
        <label class="flex font-somibold mt-4 mb-2">{{ __('質問8') }}</label>
        <div class="flex">
          <div class="mr-6">
            <input type="radio" name="answer_text_08" value="はい">
             {{-- {{ old ('answer_text_8') == '投稿しない' ? 'checked' : '' }} checked --}}
            <label for="answer_text_08" class="form-check-label">はい</label>
          </div>
          <div>
            <input type="radio" name="answer_text_08" value="いいえ">
             {{-- {{ old ('answer_text_8') == '投稿する' ? 'checked' : '' }} --}}
            <label for="answer_text_08" class="form-check-label">いいえ</label>
          </div>
        </div>
      </div>

      {{-- <input name="check" type="hidden" value="0">
      <input id="check" name="check" type="checkbox" value="1" @checked(old('check', $settings[0]->example)) >
      <label for="check">チェックボックス1</label> --}}

      {{-- type="hidden"はチェックボックスをチェックしていない場合に値を送信したいときに使用する
      type="hidden"はチェックボックス本体よりも上の行で定義する
      @checkedディレクティブがあれば参考演算子でcheckedの判定しなくてよい --}}

      <div class="w-full flex flex-col py-3">
        <label class="font-somibold mt-4 mb-2">質問9</label>
        <div class="flex">
          <div class="mr-6">
            <input type="checkbox" name="answer_text_09[]" value="1"/>
            <label for="answer_text_09">1</label>
          </div>
          <div class="mr-6">
            <input type="checkbox" name="answer_text_09[]" value="2"/>
            <label for="answer_text_09">2</label>
          </div>
          <div class="mr-6">
            <input type="checkbox" name="answer_text_09[]" value="3"/>
            <label for="answer_text_09">3</label>
          </div>
          <div class="mr-6">
            <input type="checkbox" name="answer_text_09[]" value="4"/>
            <label for="answer_text_09">4</label>
          </div>
          <div class="mr-6">
            <input type="checkbox" name="answer_text_09[]" value="5"/>
            <label for="answer_text_09">5</label>
          </div>
          <div class="mr-6">
            <input type="checkbox" name="answer_text_09[]" value="6"/>
            <label for="answer_text_09">6</label>
          </div>
        </div>
      </div>

      <div class="w-full flex flex-col py-3">
        <label for="answer_text_10" class="font-somibold mt-4 mb-2">質問10</label>
        <select class="w-80" name="answer_text_10">
          <option value="PHP">PHP</option>
          <option value="Ruby">Ruby</option>
          <option value="Laravel">Laravel</option>
          <option value="Java">Java</option>
          <option value="jQuery">jQuery</option>
        </select>
      </div>
      <div>
        <x-primary-button class="mt-8">
          送信する
        </x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>
