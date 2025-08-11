<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Voting Entry</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(session('ok')) <div class="mb-4 rounded-md bg-green-50 text-green-700 px-4 py-3">{{ session('ok') }}</div> @endif
      @if(session('err')) <div class="mb-4 rounded-md bg-red-50 text-red-700 px-4 py-3">{{ session('err') }}</div> @endif

      <form method="POST" action="{{ route('admin.voting.submit') }}" class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        @csrf
        <label class="block text-sm font-medium text-gray-700">Enter up to 3 ticket numbers (IDs), separated by space or comma:</label>
        <input name="numbers" placeholder="e.g. 12 45 118" autofocus
               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
        <button class="rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-medium hover:bg-indigo-700">Record Votes</button>
      </form>

      <div class="mt-4">
        <a href="{{ route('admin.voting.leaderboard') }}"
           class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
          View Leaderboard
        </a>
      </div>
    </div>
  </div>
</x-app-layout>
