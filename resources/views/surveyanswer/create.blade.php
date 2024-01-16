<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケート
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-6">
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
        <div class="w-full flex flex-col">
          <label for="body" class="font-somibold mt-4">{{ $survey->content }}</label>
          <!-- <x-input-error :messages="$errors->get('body')" class="mt-2" /> -->
          <input type="text" name="survey_{{ $survey->id }}" />
        </div>
      </div>
      @endforeach

      <div>
        <x-primary-button class="mt-4">
          送信する
        </x-primary-button>
    </div>
    </form>
</x-app-layout>
