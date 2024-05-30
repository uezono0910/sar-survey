<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight overflow-x-scroll">
        {{ $surveyItems->date }}のアンケート
      </h2>
  </x-slot>
  <div class="mx-12 py-12">
    <div class="overflow-scroll w-full">
      <table class="w-full">
        <thead class="bg-blue-100">
          <tr>
          @foreach($surveyItems as $surveyItem)
            <th class="min-w-64 p-2 text-left">{{ $surveyItem->content }}</th>
          @endforeach
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveyanswers as $surveyanswer)
            <tr>
              @foreach($surveyItem as $surveyItem)
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