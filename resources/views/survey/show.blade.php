<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        個別表示
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-6">
    <div class="bg-white w-full rounded-2xl">
      <div class="mt-4 p-4">
        <h1 class="text-lg font-semibold">
          {{$survey->title}}
        </h1>
        <div>
          <a href="{{route('survey.edit', $survey)}}">
            <x-primary-button>
              編集
            </x-primary-button>
          </a>
          <form method="Survey" action="{{route('survey.destroy', $survey)}}">
            @csrf
            @method('delete')
            <x-primary-button>
              削除
            </x-primary-button>
          </form>
        </div>
        <hr>
        <p class="mt-4 whitespace-pre-line">
          {{$survey->body}}
        </p>
        <div class="text-sm font-semibold flex flex-row-reverse">
          <p>
            {{$survey->created_at}}
          </p>
        </div>
      </div>
    </div>

    {{-- @foreach ($surveys as $survey)
      <div class="mt-4 p-8 bg-white w-full rounded-2xl">
        <h1 class="p-4 text-lg font-semibold">
          {{ $survey->title}}
        </h1>
        <hr class="w-full">
        <p class="mt-4 p-4">
          {{ $survey->body }}
        </p>
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
          <p>
            {{ $survey->created_at }} / {{ $survey->user->name??'匿名' }}
          </p>
        </div>
      </div>
    @endforeach --}}
  </div>
</x-app-layout>
