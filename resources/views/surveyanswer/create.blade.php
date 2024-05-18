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

      @foreach($surveyItems as $surveyItem)
        <div class="mt-8">
          <div class="w-full flex flex-col py-3">
            <label class="font-somibold mt-4 mb-2">{{ $surveyItem->content }}</label>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
            @if($surveyItem->type === "1")
              <input type="text" name="surveyItem_{{ $surveyItem->id }}" />
            @elseif($surveyItem->type === "2")
              <textarea class="min-h-32" name="surveyItem_{{ $surveyItem->id }}"></textarea>
            @elseif($surveyItem->type === "3")
              <select class="w-1/2" name="surveyItem_{{ $surveyItem->id }}">
              @foreach (explode(",",$surveyItem->choices) as $choice)
                <option>{{ $choice }}</option>
              @endforeach
              </select>
            @elseif($surveyItem->type === "4")
              <div class="flex">
              @foreach (explode(",",$surveyItem->choices) as $choice)
                <div class="mr-6">
                  <input type="radio" name="surveyItem_{{ $surveyItem->id }}" value="{{$choice}}" />
                  <label>{{ $choice }}</label>
                </div>
              @endforeach
              </div>
            @elseif($surveyItem->type === "5")
              <div class="flex">
              @foreach (explode(",",$surveyItem->choices) as $choice)
                <div class="mr-6">
                  <input type="checkbox" name="surveyitem_{{ $surveyitem->id }}[]" value="{{$choice}}" />
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