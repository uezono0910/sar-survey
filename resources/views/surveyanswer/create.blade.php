<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold sm:text-xl text-gray-800 leading-tight">
        freelance-villageもくもく会アンケート
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-3 py-6 sm:px-40 sm:py-12">
    {{-- @if (session('message'))
      <div>
        {{ session('message') }}
      </div>
    @endif --}}
    <x-message :message="session('message')" />
    <form method="POST" action="{{ route('surveyanswer.store', $survey->id) }}">
      @csrf
      @foreach($surveyDetails as $surveyDetail)
        <input class="ml-4" type="hidden" name="survey" value="{{ $survey->id }}" />
        <div class="sm:mt-12 mt-2">
          <div class="sm:w-full flex flex-col text-sm">
            <div class="mt-4">
              <label class="font-somibold"><span>■</span> {{ $surveyDetail->content }}</label>
            </div>
            <div class="mt-4 px-4">
              {{-- <x-input-error :messages="$errors->get('body')" class="mt-2" /> --}}
              @if($surveyDetail->type == "テキストボックス")
                <input class="w-full" type="text" name="surveyDetail_{{ $surveyDetail->id }}" />
              @elseif($surveyDetail->type == "テキストエリア")
                <textarea class="min-h-32" name="surveyDetail_{{ $surveyDetail->id }}"></textarea>
              @elseif($surveyDetail->type == "セレクトボックス")
                <select class="w-1/2" name="surveyDetail_{{ $surveyDetail->id }}">
                @foreach (explode(",",$surveyDetail->choices) as $choice)
                  <option>{{ $choice }}</option>
                @endforeach
                </select>
              @elseif($surveyDetail->type == "ラジオボタン")
                <div class="flex flex-wrap">
                @foreach (explode(",",$surveyDetail->choices) as $choice)
                  <div class="mr-6">
                    <input type="radio" name="surveyDetail_{{ $surveyDetail->id }}" value="{{$choice}}" />
                    <label>{{ $choice }}</label>
                  </div>
                @endforeach
                </div>
              @elseif($surveyDetail->type == "チェックボックス")
                <div class="flex flex-wrap mr-4">
                @foreach (explode(",",$surveyDetail->choices) as $choice)
                  <div class="mr-6">
                    <input type="checkbox" name="surveyDetail_{{ $surveyDetail->id }}[]" value="{{$choice}}" />
                    <label>{{ $choice }}</label>
                  </div>
                @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach

      {{-- <x-primary-button class="mt-4"> --}}
      <x-primary-button class="sm:mt-32 mt-12">
        送信する
      </x-primary-button>
    </form>
</x-app-layout>