<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight overflow-x-scroll">
        {{ $surveys->title }}の回答（{{ $surveys->date }}）
      </h2>
  </x-slot>
  <div class="mx-12 py-12">
    <div class="overflow-scroll w-full">
      <table class="w-full">
        <thead class="bg-blue-100">
          <tr>
          <th class="whitespace-nowrap p-2 text-left">投稿日</th>
          @foreach($surveyItems as $surveyItem)
            <th class="min-w-64 p-2 text-left">{{ $surveyItem->content }}</th>
          @endforeach
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveyAnswers as $surveyAnswer)
            <tr>
              <td class="whitespace-wrap p-2 text-left">{{ $surveyAnswer->created_at }}</td>
              @foreach($surveyItems as $surveyItem)
              <td>
                @foreach ($surveyAnswerDetails as $surveyAnswerDetail)
                  @if ($surveyAnswer->id == $surveyAnswerDetail->survey_answer_id && $surveyItem->id == $surveyAnswerDetail->survey_item_id)
                    {{ $surveyAnswerDetail->answer }}
                  @endif
                @endforeach
              </td>
              @endforeach
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
  max-width: 300px;
}
th {
  white-space: wrap;
}
</style>