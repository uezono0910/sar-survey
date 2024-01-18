<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight overflow-x-scroll">
        一覧表示
      </h2>
  </x-slot>
  <div class="px-6 py-12">
    <div class="overflow-x-scroll">
      <table class="w-full">
        <thead class="bg-blue-100">
          <tr>
            <th class="whitespace-nowrap">回答日</th>
            <th class="whitespace-nowrap">質問1</th>
            <th class="whitespace-nowrap">質問2</th>
            <th class="whitespace-nowrap">質問3</th>
            <th class="whitespace-nowrap">質問4</th>
            <th class="whitespace-nowrap">質問5</th>
            <th class="whitespace-nowrap">質問6</th>
            <th class="whitespace-nowrap">質問7</th>
            <th class="whitespace-nowrap">質問8</th>
            <th class="whitespace-nowrap">質問9</th>
            <th class="whitespace-nowrap">質問10</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveyanswers as $surveyanswer)
          <tr>
            <td class="answered_at">{{ $surveyanswer->answered_at }}</td>
            <td class="whitespace-nowrap">{{ $surveyanswer->answer_text_01 }}</td>
            <td class="min-w-80">{{ $surveyanswer->answer_text_02 }}</td>
            <td class="min-w-80">{{ $surveyanswer->answer_text_03 }}</td>
            <td class="min-w-80">{{ $surveyanswer->answer_text_04 }}</td>
            <td class="min-w-80">{{ $surveyanswer->answer_text_05 }}</td>
            <td class="min-w-80">{{ $surveyanswer->answer_text_06 }}</td>
            <td class="min-w-80">{{ $surveyanswer->answer_text_07 }}</td>
            <td class="whitespace-nowrap">{{ $surveyanswer->answer_text_08 }}</td>
            <td class="whitespace-nowrap">{{ $surveyanswer->answer_text_09 }}</td>
            <td class="whitespace-nowrap">{{ $surveyanswer->answer_text_10 }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
<style>
th, td {
  border: solid .5px #d3d3d3;
  padding: .5rem;
  text-align: center;
  max-width: 300px;
}
th, .answered_at {
  white-space: nowrap;
}
</style>