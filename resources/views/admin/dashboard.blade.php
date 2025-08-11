<x-app-layout>
  {{-- Optional header slot shown in the top bar --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Admin
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      {{-- your existing content can stay; Tailwind classes will style better,
           but Bootstrap classes will still render functionally --}}
      <div class="container py-4">
        <div class="row g-3">
          {{-- ... existing stat cards ... --}}
          <div class="col-md-3"><div class="card"><div class="card-body">
            <div class="small text-muted">Registrations</div>
            <div class="h3 mb-0">{{ $stats['registrations'] }}</div>
            <div class="small text-muted">Test: {{ $stats['registrations_test'] }}</div>
          </div></div></div>

          <div class="col-md-3"><div class="card"><div class="card-body">
            <div class="small text-muted">Checked In</div>
            <div class="h3 mb-0">{{ $stats['checked_in'] }}</div>
            <div class="small text-muted">Test: {{ $stats['checked_in_test'] }}</div>
          </div></div></div>

          <div class="col-md-3"><div class="card"><div class="card-body">
            <div class="small text-muted">Shirts Given</div>
            <div class="h3 mb-0">{{ $stats['shirts'] }}</div>
            <div class="small text-muted">Test: {{ $stats['shirts_test'] }}</div>
          </div></div></div>

          <div class="col-md-3"><div class="card"><div class="card-body">
            <div class="small text-muted">Votes (all)</div>
            <div class="h3 mb-0">{{ $stats['votes'] }}</div>
          </div></div></div>
        </div>
        <div class="mt-4 d-flex gap-2">
          <a class="btn btn-primary" href="{{ route('admin.search') }}">Check‑In</a>
          <a class="btn btn-outline-primary" href="{{ route('admin.voting') }}">Voting</a>
          <a class="btn btn-outline-primary" href="{{ route('admin.drawings') }}">Drawings</a>
        </div>
        
      </div>
    </div>
  </div>
</x-app-layout>
