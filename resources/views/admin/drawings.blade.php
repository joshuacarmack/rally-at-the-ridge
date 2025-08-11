<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Drawings</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(session('ok')) <div class="mb-4 rounded-md bg-green-50 text-green-700 px-4 py-3">{{ session('ok') }}</div> @endif
      @if(session('err')) <div class="mb-4 rounded-md bg-red-50 text-red-700 px-4 py-3">{{ session('err') }}</div> @endif

      <form method="POST" action="{{ route('admin.draw') }}">
        @csrf
        <button class="rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-medium hover:bg-indigo-700">Draw Winner</button>
      </form>

      <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
          <h3 class="text-sm font-semibold text-gray-700 mb-2">Unclaimed</h3>
          <div class="bg-white rounded-xl shadow-sm divide-y">
            @forelse($unclaimed as $d)
              <div class="p-4 flex items-center justify-between">
                <div>
                  <div class="font-medium">
                    {{ optional($d->car)->first_name }} {{ optional($d->car)->last_name }} — Ticket {{ optional($d->car)->id }}
                    @if(optional($d->car)->is_test)
                      <span class="ml-2 inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">TEST</span>
                    @endif
                  </div>
                  <div class="text-xs text-gray-500">{{ $d->created_at->format('H:i') }}</div>
                </div>
                <form method="POST" action="{{ route('admin.draw.claim',$d) }}">
                  @csrf
                  <button class="rounded-lg bg-green-600 text-white px-3 py-2 text-sm font-medium hover:bg-green-700">Mark Claimed</button>
                </form>
              </div>
            @empty
              <div class="p-4 text-gray-500">No unclaimed prizes.</div>
            @endforelse
          </div>
        </div>

        <div>
          <h3 class="text-sm font-semibold text-gray-700 mb-2">Recent History</h3>
          <ol class="bg-white rounded-xl shadow-sm divide-y">
            @foreach($history as $d)
              <li class="p-4 flex items-center justify-between">
                <div>
                  <div class="font-medium">
                    {{ $d->created_at->format('H:i') }} — {{ optional($d->car)->first_name }} {{ optional($d->car)->last_name }} — Ticket {{ optional($d->car)->id }}
                    @if(optional($d->car)->is_test)
                      <span class="ml-2 inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">TEST</span>
                    @endif
                  </div>
                </div>
                @if($d->claimed)
                  <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Claimed</span>
                @else
                  <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700">Unclaimed</span>
                @endif
              </li>
            @endforeach
          </ol>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
