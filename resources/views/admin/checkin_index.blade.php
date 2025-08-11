<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Check‑In</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(session('ok')) <div class="mb-4 rounded-md bg-green-50 text-green-700 px-4 py-3">{{ session('ok') }}</div> @endif
      @if(session('err')) <div class="mb-4 rounded-md bg-red-50 text-red-700 px-4 py-3">{{ session('err') }}</div> @endif

      <form method="GET" action="{{ route('admin.checkin.index') }}" class="flex gap-2">
        <input name="q" value="{{ $q }}" placeholder="Search by ticket (ID) or name"
               class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
        <button class="rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-medium hover:bg-indigo-700">Search</button>
        <a href="{{ route('admin.checkin.index') }}"
           class="rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">Clear</a>
      </form>

      <div class="mt-6 bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ticket</th>
              <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
              <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
              <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Color</th>
              <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
              <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-100">
            @forelse($cars as $car)
              <tr class="hover:bg-gray-50">
                <td class="px-3 py-2 text-sm text-gray-700">#{{ $car->id }}</td>
                <td class="px-3 py-2 text-sm text-gray-900">
                  {{ $car->first_name }} {{ $car->last_name }}
                  @if($car->is_test)
                    <span class="ml-2 inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">TEST</span>
                  @endif
                </td>
                <td class="px-3 py-2 text-sm text-gray-700">
                  {{ $car->year ?? '—' }} {{ $car->make ?? '' }} {{ $car->model ?? '' }}
                </td>
                <td class="px-3 py-2 text-sm text-gray-700">{{ $car->color ?? '—' }}</td>
                <td class="px-3 py-2">
                  <div class="flex flex-wrap gap-2">
                    @if($car->checked_in)
                      <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Checked In</span>
                      @unless($car->tshirt_given)
                      <span class="inline-flex items-center rounded-full bg-sky-100 px-2.5 py-0.5 text-xs font-medium text-red-700"> NoShirt</span>
                      @endunless
                    @endif
                    
                  </div>
                </td>
                <td class="px-3 py-2 text-right">
                  <a href="{{ route('admin.cars.show', $car) }}"
                     class="inline-flex items-center rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                    View
                  </a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="px-3 py-6 text-center text-gray-500">No results.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        {{ $cars->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
