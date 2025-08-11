<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Check‑In</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(session('ok')) <div class="mb-4 rounded-md bg-green-50 text-green-700 px-4 py-3">{{ session('ok') }}</div> @endif
      @if(session('err')) <div class="mb-4 rounded-md bg-red-50 text-red-700 px-4 py-3">{{ session('err') }}</div> @endif

      <form method="GET" class="flex gap-2">
        <input name="q" value="{{ $q }}" placeholder="Search by ticket (ID) or name"
               class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
        <button class="rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-medium hover:bg-indigo-700">Search</button>
      </form>

      @if($cars->isNotEmpty())
        <div class="mt-6 space-y-4">
          @foreach($cars as $car)
            <div class="bg-white rounded-xl shadow-sm p-4">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <div class="font-semibold">
                    Ticket {{ $car->id }} — {{ $car->first_name }} {{ $car->last_name }}
                  </div>
                  <div class="mt-1 flex flex-wrap gap-2">
                    @if($car->is_test)
                      <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">TEST</span>
                    @endif
                    @if($car->checked_in)
                      <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Checked In</span>
                    @endif
                    @if($car->tshirt_given)
                      <span class="inline-flex items-center rounded-full bg-sky-100 px-2.5 py-0.5 text-xs font-medium text-sky-700">Shirt</span>
                    @endif
                  </div>
                </div>

                <div class="flex gap-2">
                  @if(!$car->checked_in)
                    <form method="POST" action="{{ route('admin.checkin',$car) }}">
                      @csrf
                      <input type="hidden" name="comments" value="{{ $car->comments }}">
                      <button class="rounded-lg bg-green-600 text-white px-3 py-2 text-sm font-medium hover:bg-green-700">Check In</button>
                    </form>
                  @endif
                  @if(!$car->tshirt_given)
                    <form method="POST" action="{{ route('admin.shirt',$car) }}">
                      @csrf
                      <button class="rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">Give Shirt</button>
                    </form>
                  @endif
                </div>
              </div>

              <form method="POST" action="{{ route('admin.comment',$car) }}" class="mt-3">
                @csrf
                <textarea name="comments" rows="2" placeholder="Add comments…"
                          class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('comments',$car->comments) }}</textarea>
                <div class="mt-2">
                  <button class="rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">Save Comments</button>
                </div>
              </form>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
