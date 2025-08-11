<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="text-gray-500 uppercase tracking-wide text-xs">Registrations</div>
          <div class="mt-1 text-3xl font-semibold">{{ $stats['registrations'] }}</div>
          <div class="mt-1 text-xs text-gray-500">Test: {{ $stats['registrations_test'] }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="text-gray-500 uppercase tracking-wide text-xs">Checked In</div>
          <div class="mt-1 text-3xl font-semibold">{{ $stats['checked_in'] }}</div>
          <div class="mt-1 text-xs text-gray-500">Test: {{ $stats['checked_in_test'] }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="text-gray-500 uppercase tracking-wide text-xs">Shirts Given</div>
          <div class="mt-1 text-3xl font-semibold">{{ $stats['shirts'] }}</div>
          <div class="mt-1 text-xs text-gray-500">Test: {{ $stats['shirts_test'] }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="text-gray-500 uppercase tracking-wide text-xs">Votes (all)</div>
          <div class="mt-1 text-3xl font-semibold">{{ $stats['votes'] }}</div>
        </div>
      </div>

      <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('admin.search') }}" class="inline-flex items-center rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-medium hover:bg-indigo-700">Check‑In</a>
        <a href="{{ route('admin.voting') }}" class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">Voting</a>
        <a href="{{ route('admin.drawings') }}" class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">Drawings</a>
      </div>
    </div>
  </div>
</x-app-layout>
