  {{-- Optional header slot shown in the top bar --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Drawings
    </h2>
  </x-slot>

<div class="py-6">
  <h1>Drawings</h1>
  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
  @if(session('err')) <div class="alert alert-danger">{{ session('err') }}</div> @endif

  <form method="POST" action="{{ route('admin.draw') }}">@csrf
    <button class="btn btn-primary">Draw Winner</button>
  </form>

  <h3 class="mt-4">Unclaimed</h3>
  <ul class="list-group">
    @forelse($unclaimed as $d)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ optional($d->car)->first_name }} {{ optional($d->car)->last_name }}
        — Ticket {{ optional($d->car)->id }}
        @if(optional($d->car)->is_test)
          <span class="badge bg-secondary ms-2">TEST</span>
        @endif
        <form method="POST" action="{{ route('admin.draw.claim',$d) }}">@csrf
          <button class="btn btn-success btn-sm">Mark Claimed</button>
        </form>
      </li>
    @empty
      <li class="list-group-item">No unclaimed prizes.</li>
    @endforelse
  </ul>

  <h3 class="mt-4">Recent History</h3>
  <ol class="list-group list-group-numbered">
    @foreach($history as $d)
      <li class="list-group-item">
        {{ $d->created_at->format('H:i') }} — {{ optional($d->car)->first_name }} {{ optional($d->car)->last_name }}
        — Ticket {{ optional($d->car)->id }}
        @if($d->claimed) <span class="badge bg-success ms-2">Claimed</span>
        @else <span class="badge bg-warning ms-2">Unclaimed</span> @endif
        @if(optional($d->car)->is_test) <span class="badge bg-secondary ms-2">TEST</span> @endif
      </li>
    @endforeach
  </ol>
</div>
</x-app-layout>
