<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        一覧表示
      </h2>
  </x-slot>
  <div class="w-screen py-6">
    <div>
      <div class="border-solid py-6 px-6">回答日</div>
      <div class="border-solid py-6 px-6">質問1</div>
      <div class="border-solid py-6 px-6">質問2</div>
      <div class="border-solid py-6 px-6">質問3</div>
      <div class="border-solid py-6 px-6">質問4</div>
      <div class="border-solid py-6 px-6">質問5</div>
      <div class="border-solid py-6 px-6">質問6</div>
      <div class="border-solid py-6 px-6">質問7</div>
      <div class="border-solid py-6 px-6">質問8</div>
      <div class="border-solid py-6 px-6">質問9</div>
      <div class="border-solid py-6 px-6">質問10</div>
    </div>
    <div>
      @foreach ($surveyanswers as $surveyanswer)
      <div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answered_at }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_01 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_02 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_03 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_04 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_05 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_06 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_07 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_08 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_09 }}</div>
        <div class="border-solid py-6 px-6">{{ $surveyanswers->answer_text_10 }}</div>
      </div>
      @endforeach
    </div>
  </div>
</x-app-layout>
