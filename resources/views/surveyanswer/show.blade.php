<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        回答詳細
      </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-6">
    <div class="bg-white w-full rounded-2xl">
      <div class="mt-4 p-4">
        <h1 class="text-lg font-semibold">
          {{Auth::user()->id}}
        </h1>
        <form method="POST" action="{{ route('surveyanswer.store') }}">
          @csrf
          @foreach($surveys as $survey)
          <div class="mt-8">
            <div class="w-full flex flex-col">
              <label for="body" class="font-somibold mt-4">{{ $survey->content }}</label>
              <!-- <x-input-error :messages="$errors->get('body')" class="mt-2" /> -->
              <!-- <input type="text" name="survey_{{ $survey->id }}" /> -->
            </div>
          </div>
          @endforeach
        </form>
        <!-- <div>

            <x-primary-button>
              編集
            </x-primary-button>
          </a>
            @csrf
            @method('delete')
            <x-primary-button>
              削除
            </x-primary-button>
          </form>
        </div> -->
        <hr>
        <p class="mt-4 whitespace-pre-line">
          {{$surveyanswer->answer}}
        </p>
        <div class="text-sm font-semibold flex flex-row-reverse">
          <p>
            {{$surveyanswer->created_at}}
          </p>
        </div>
      </div>
    </div>

    <!-- {{-- @foreach ($surveyanswers as $surveyanswer)
      <div class="mt-4 p-8 bg-white w-full rounded-2xl">
        <h1 class="p-4 text-lg font-semibold">
          {{ $surveyanswer->title}}
        </h1>
        <hr class="w-full">
        <p class="mt-4 p-4">
          {{ $surveyanswer->body }}
        </p>
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
          <p>
            {{ $surveyanswer->created_at }} / {{ $surveyanswer->user->name??'匿名' }}
          </p>
        </div>
      </div>
    @endforeach --}} -->
  </div>
</x-app-layout>
