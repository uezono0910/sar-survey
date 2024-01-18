<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          アンケートフォーム作成
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-6">
    {{-- @if (session('message'))
      <div>
        {{ session('message') }}
      </div>
    @endif --}}
    <x-message :message="session('message')" />
    <form method="survey" action="{{ route('survey.store') }}">
      @csrf
      <div class="mt-8">
        <div class="w-full flex flex-col">
          <label for="title" class="font-somibold mt-4">名前（任意）</label>
          <x-input-error :messages="$errors->get('title')" class="mt-2" />
          <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="title"
          value="{{ old('title') }}">
        </div>
      </div>


      @foreach($surveys as $survey)
        {{ $survey }} <br />

        <!-- <div class="w-full flex flex-col">
          <label for="body" class="font-somibold mt-4">本文</label>
          <x-input-error :messages="$errors->get('body')" class="mt-2" />
          <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="1" rows="5">{{ old('body') }}</textarea>
        </div> -->
      @endforeach

      <x-primary-button class="mt-4">
        送信する
      </x-primary-button>
    </form>
</x-app-layout>
