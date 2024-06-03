<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-6 px-40 py-12">
    {{-- @if (session('message'))
      <div>
        {{ session('message') }}
      </div>
    @endif --}}
    <x-message :message="session('message')" />
    <form method="POST" action="{{ route('surveyanswer.store') }}">
      @csrf
      @foreach($surveyDetails as $surveyDetail)
        <div class="mt-8">
          <div class="w-full flex flex-col py-3">
            <label ■ class="font-somibold mt-4 mb-4">■ {{ $surveyDetail->content }}</label>
            {{-- <x-input-error :messages="$errors->get('body')" class="mt-2" /> --}}
            @if($surveyDetail->type == "テキストボックス")
              <input class="ml-4" type="text" name="survey_{{ $surveyDetail->id }}" />
            @elseif($surveyDetail->type == "テキストエリア")
              <textarea class="min-h-32 ml-4" name="survey_{{ $surveyDetail->id }}"></textarea>
            @elseif($surveyDetail->type == "セレクトボックス")
              <select class="w-1/2 ml-4" name="survey_{{ $surveyDetail->id }}">
              @foreach (explode(",",$surveyDetail->choices) as $choice)
                <option>{{ $choice }}</option>
              @endforeach
              </select>
            @elseif($surveyDetail->type == "ラジオボタン")
              <div class="flex flex-wrap ml-4">
              @foreach (explode(",",$surveyDetail->choices) as $choice)
                <div class="mr-6">
                  <input type="radio" name="survey_{{ $surveyDetail->id }}" value="{{$choice}}" />
                  <label>{{ $choice }}</label>
                </div>
              @endforeach
              </div>
            @elseif($surveyDetail->type == "チェックボックス")
              <div class="flex flex-wrap ml-4">
              @foreach (explode(",",$surveyDetail->choices) as $choice)
                <div class="mr-6">
                  <input type="checkbox" name="survey_{{ $surveyDetail->id }}[]" value="{{$choice}}" />
                  <label>{{ $choice }}</label>
                </div>
              @endforeach
              </div>
            @endif
          </div>
        </div>
      @endforeach

      {{-- <x-primary-button class="mt-4"> --}}
      <x-primary-button class="mt-8">
        送信する
      </x-primary-button>
    </form>
</x-app-layout>