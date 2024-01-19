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
            <th class="whitespace-nowrap">質問内容</th>
            <th class="whitespace-nowrap">フォームタイプ</th>
            <th class="whitespace-nowrap">選択肢</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveys as $survey)
            <tr>
              <td class="min-w-80">{{ $survey->content }}</td>
              <td class="min-w-80">{{ $survey->type }}</td>
              <td class="min-w-80">{{ $survey->choices }}</td>
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
th {
  white-space: nowrap;
}
</style>