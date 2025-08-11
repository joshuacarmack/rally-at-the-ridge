<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Check‑In — Ticket #{{ $car->id }}</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

      <a href="{{ route('admin.checkin.index') }}"
         class="inline-flex items-center rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
        ← Back to Search
      </a>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 space-y-2">
          <h3 class="font-semibold text-gray-800">Owner</h3>
          <div class="text-sm text-gray-700">{{ $car->first_name }} {{ $car->last_name }} @if($car->is_test)<span class="ml-2 rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-700">TEST</span>@endif</div>
          <div class="text-sm text-gray-600">{{ $car->email }}</div>
          <div class="text-sm text-gray-600">{{ $car->phone }}</div>
          <div class="text-sm text-gray-600">{{ $car->address }} {{ $car->city }} {{ $car->state }} {{ $car->zip }}</div>
          <div class="text-sm text-gray-600">Previously attended: {{ $car->previously_attended ? 'Yes' : 'No' }}</div>
          <div class="text-sm text-gray-600">Home church: {{ $car->home_church ?? '—' }}</div>
          <div class="text-sm text-gray-600">Party size: {{ $car->party_size }}</div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 space-y-2">
          <h3 class="font-semibold text-gray-800">Vehicle</h3>
          <div class="text-sm text-gray-700">{{ strtoupper($car->vehicle_type ?? '—') }}</div>
          <div class="text-sm text-gray-600">{{ $car->year ?? '—' }} {{ $car->make ?? '' }} {{ $car->model ?? '' }}</div>
          <div class="text-sm text-gray-600">Color: {{ $car->color ?? '—' }}</div>
          <div class="text-sm text-gray-600">T‑Shirt size: {{ $car->tshirt_size ?? '—' }}</div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-3">Actions</h3>
        <div class="flex flex-wrap gap-3">
          @if(!$car->checked_in)
            <form method="POST" action="{{ route('admin.checkin', $car) }}">
              @csrf
              <input type="hidden" name="comments" value="{{ $car->comments }}">
              <button class="rounded-lg bg-green-600 text-white px-4 py-2 text-sm font-medium hover:bg-green-700">
                Check In
              </button>
            </form>
          @else
            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Already checked in at {{ optional($car->checked_in_at)->format('H:i') }}</span>
          @endif

          @if(!$car->tshirt_given)
            <form method="POST" action="{{ route('admin.shirt', $car) }}">@csrf
              <button class="rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                Mark Shirt Given
              </button>
            </form>
          @else
            <span class="inline-flex items-center rounded-full bg-sky-100 px-2.5 py-0.5 text-xs font-medium text-sky-700">Shirt given</span>
          @endif
        </div>

        <form method="POST" action="{{ route('admin.comment', $car) }}" class="mt-4">
          @csrf
          <label class="block text-sm font-medium text-gray-700 mb-1">Comments</label>
          <textarea name="comments" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('comments', $car->comments) }}</textarea>
          <div class="mt-2">
            <button class="rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">Save Comments</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</x-app-layout>
