<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight overflow-x-scroll">
        アンケート回答一覧
      </h2>
  </x-slot>
  <div class="mx-12 py-12">
    <div class="overflow-scroll w-full">
      <table class="w-full">
        <thead class="bg-blue-100">
          <tr>
          <th class="whitespace-nowrap p-2 text-left">投稿日</th>
          @foreach($surveys as $survey)
            <th class="min-w-64 p-2 text-left">{{ $survey->content }}</th>
          @endforeach
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveyanswers as $surveyanswer)
            <tr>
              <td class="whitespace-nowrap p-2 text-left">{{ $surveyanswer->created_at }}</td>
              @foreach($surveys as $survey)
                <td>
                @foreach ($surveyanswerdetails as $surveyanswerdetail)
                    @if ($surveyanswer->id === $surveyanswerdetail->survey_answer_id && $survey->id === $surveyanswerdetail->survey_id)
                      {{ $surveyanswerdetail->answer }}
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
}
</style>