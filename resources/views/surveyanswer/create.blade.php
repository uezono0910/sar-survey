<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-40 py-12">
    {{-- @if (session('message'))
      <div>
        {{ session('message') }}
      </div>
    @endif --}}
    <x-message :message="session('message')" />
    <form method="POST" action="{{ route('surveyanswer.store') }}">
      @csrf

      @foreach($surveys as $survey)
        <div class="mt-8">
          <div class="w-full flex flex-col py-3">
            <label class="font-somibold mt-4 mb-2">{{ $survey->content }}</label>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
            @if($survey->type === "1")
              <input type="text" name="{{ $survey->id }}" />
              {{-- <input type="hidden" name="survey_{{ $survey->id }}" value="{{ $survey->id }}" /> --}}
            @elseif($survey->type === "2")
              <textarea class="min-h-32" name="{{ $survey->id }}"></textarea>
              {{-- <input type="hidden" name="survey_{{ $survey->id }}" value="{{ $survey->id }}" /> --}}
            @elseif($survey->type === "3")
              {{-- <input type="hidden" name="survey_{{ $survey->id }}" value="{{ $survey->id }}" /> --}}
              <select class="w-1/2" name="{{ $survey->id }}">
              @foreach (explode(",",$survey->choices) as $choice)
                <option>{{ $choice }}</option>
              @endforeach
              </select>
            @elseif($survey->type === "4")
              {{-- <input type="hidden" name="survey_{{ $survey->id }}" value="{{ $survey->id }}" /> --}}
              <div class="flex">
              @foreach (explode(",",$survey->choices) as $choice)
                <div class="mr-6">
                  <input type="radio" name="{{ $survey->id }}" value="{{$choice}}" />
                  <label>{{ $choice }}</label>
                </div>
              @endforeach
              </div>
            @elseif($survey->type === "5")
              {{-- <input type="hidden" name="survey_{{ $survey->id }}" value="{{ $survey->id }}" /> --}}
              <div class="flex">
              @foreach (explode(",",$survey->choices) as $choice)
                <div class="mr-6">
                  <input type="checkbox" name="{{ $survey->id }}" value="{{$choice}}" />
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