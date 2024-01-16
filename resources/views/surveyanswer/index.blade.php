<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        一覧表示
      </h2>
  </x-slot>
  <div class="mx-auto px-6">
    @if(session('message'))
      <div>{{session('message')}}</div>
    @endif
    @foreach ($surveyanswers as $surveyanswer)
      <div class="mt-4 p-8 bg-white w-full rounded-2xl">
        <h1 class="p-4 text-lg font-semibold">
          <a href="{{route('surveyanswer.show', $surveyanswer)}}" class="text-blue-600">
            {{ $surveyanswer->user->name??'匿名' }}
          </a>
        </h1>
        <hr class="w-full">
        <p class="mt-4 p-4">
          {{ $surveyanswer->created_at }}
        </p>
      </div>
    @endforeach
    <div>
      {{ $surveyanswers->links() }}
    </div>
  </div>
</x-app-layout>
