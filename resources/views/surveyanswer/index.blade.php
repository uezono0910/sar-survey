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
          <th class="whitespace-nowrap">投稿日</th>
          @foreach($surveys as $survey)
            <th class="whitespace-nowrap">{{ $survey->content }}</th>
          @endforeach
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveyanswers as $surveyanswer)
            <tr>
              <td class="whitespace-nowrap">{{ $surveyanswer->created_at }}</td>
              @foreach($surveys as $survey)
                <td class="answered_at">
                @foreach ($surveyanswerdetails as $surveyanswerdetail)
                    @if ($surveyanswer->id === $surveyanswerdetail->survey_answer_id && $survey->id === $surveyanswerdetail->survey_id)
                      {{-- <td class="answered_at"> --}}
                      {{ $surveyanswerdetail->answer }}
                      {{-- </td> --}}
                    {{-- @else
                      <td class="answered_at"></td> --}}
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
  text-align: center;
  max-width: 300px;
}
th, .answered_at {
  white-space: nowrap;
}
</style>