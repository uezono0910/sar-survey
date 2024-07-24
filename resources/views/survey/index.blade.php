<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight overflow-x-scroll">
        アンケート一覧
      </h2>
  </x-slot>
  <div class="px-12 py-12">
    <div class="overflow-x-scroll">
      <table class="w-full">
        <thead class="bg-blue-100">
          <tr>
            <th class="whitespace-nowrap">公開日</th>
            <th class="whitespace-nowrap">タイトル</th>
            <th class="whitespace-nowrap">項目数</th>
            <th class="whitespace-nowrap">回答数</th>
            <th class="whitespace-nowrap">URL</th>
            <th class="whitespace-nowrap">備考</th>
            <th class="whitespace-nowrap">プレビュー</th>
            <th class="whitespace-nowrap">回答詳細</th>
            <th class="whitespace-nowrap">編集</th>
            <th class="whitespace-nowrap">削除</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($surveys as $survey)
            <tr>
              <td>{{ $survey->date }}</td>
              <td class="min-w-40">{{ $survey->title }}</td>
              <td>{{ $surveyDetailsCount[$survey->id] }}</td>
              <td>{{ $surveyAnswersCount[$survey->id] }}</td>
              <td><a class="text-blue-500 hover:text-blue-700" href="{{ $survey->url }}" target=”_blank”>{{ $survey->url }}</a></td>
              <td class="min-w-80">{{ $survey->note }}</td>
              <td class="flex justify-center"><div class="text-center cursor-pointer p-0.5 hover:bg-gray-300 rounded border border-gray-400 ease-in duration-300 "><a href="{{ route('survey.show', $survey->id) }}" target="_blank">プレビュー</a></div></td>
              <td><a class="m-auto" href="{{ route('surveyanswer.show', ['surveyAnswer'=>$survey->id]) }}"><img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAWklEQVR4nO2VwQkAIQwEpzz7LyFXyN5HQVA5JCrCZUAQIjuPkAjBBAl4ADmP5awGWxCuStJQil40yjkqUOeuj7e6SuBBVwgUPSB6wC/nwHav67RIYqMPJ6DHC6Jsv3ofzjEAAAAAAElFTkSuQmCC"></a></td>
              <td><a class="m-auto" href="{{ route('survey.edit', ['survey'=>$survey->id]) }}"><img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAr0lEQVR4nO2UQQrCMBBF5woiQt4v9B6u9B4exKUuewD1OHoKDyK4j0QbWopZdbrLh4HM5v2ZDxOzKjMDzpK6JeGxL38T4Dgy8DMJIewKW8TUz4IzALvCJicPeJxOm96zpmcCd82dMvxbTdPsF4PLM3NV+OKxJElaA7d/8NlXmhVC2LjDgYOkbe7btl3lTVwmBy6SXmMT/eLyiQV49HG8x7+lmyQ9gTtwTXH5kausrA8EoobA4svtJQAAAABJRU5ErkJggg=="></a></td>
              <td>
                <form action="{{route('survey.destroy', $survey->id)}}" method="post" class="m-auto">
                  @csrf
                  @method('delete')
                  <input type="image" class="m-auto" onclick='return confirm("削除しますか？");' alt="svgImg" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIKc3R5bGU9ImZpbGw6IzFBMUExQTsiPgogICAgPHBhdGggZD0iTSAxMCAyIEwgOSAzIEwgNSAzIEMgNC40NDggMyA0IDMuNDQ4IDQgNCBDIDQgNC41NTIgNC40NDggNSA1IDUgTCA3IDUgTCAxNyA1IEwgMTkgNSBDIDE5LjU1MiA1IDIwIDQuNTUyIDIwIDQgQyAyMCAzLjQ0OCAxOS41NTIgMyAxOSAzIEwgMTUgMyBMIDE0IDIgTCAxMCAyIHogTSA1IDcgTCA1IDIwIEMgNSAyMS4xMDUgNS44OTUgMjIgNyAyMiBMIDE3IDIyIEMgMTguMTA1IDIyIDE5IDIxLjEwNSAxOSAyMCBMIDE5IDcgTCA1IDcgeiI+PC9wYXRoPgo8L3N2Zz4=">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{-- <div class="flex justify-end mr-12">
    <x-primary-button>
    </x-primary-button>
  </div> --}}
</x-app-layout>

<style>
th, td {
  border: solid .5px #d3d3d3;
  text-align: center;
  padding: .5rem;
  max-width: 300px;
}
th {
  white-space: nowrap;
}
</style>