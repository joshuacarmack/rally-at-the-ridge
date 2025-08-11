<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <!-- Page title here, e.g. "Check‑In" -->
      Search
    </h2>
  </x-slot>

<div class="container py-4">
  <h1>Check‑In</h1>
  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
  @if(session('err')) <div class="alert alert-danger">{{ session('err') }}</div> @endif

  <form method="GET" class="mb-3">
    <div class="input-group">
      <input name="q" class="form-control" value="{{ $q }}" placeholder="Search by ticket (ID) or name">
      <button class="btn btn-primary">Search</button>
    </div>
  </form>

  @if($cars->isNotEmpty())
    <div class="list-group">
      @foreach($cars as $car)
        <div class="list-group-item">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <strong>Ticket {{ $car->id }}</strong>
              — {{ $car->first_name }} {{ $car->last_name }}
              @if($car->is_test)
                <span class="badge bg-secondary ms-2">TEST</span>
              @endif
              @if($car->checked_in)
                <span class="badge bg-success ms-2">Checked In</span>
              @endif
              @if($car->tshirt_given)
                <span class="badge bg-info ms-1">Shirt</span>
              @endif
            </div>
            <div class="d-flex gap-2">
              @if(!$car->checked_in)
                <form method="POST" action="{{ route('admin.checkin',$car) }}">
                  @csrf
                  <input type="hidden" name="comments" value="{{ $car->comments }}">
                  <button class="btn btn-success btn-sm">Check In</button>
                </form>
              @endif
              @if(!$car->tshirt_given)
                <form method="POST" action="{{ route('admin.shirt',$car) }}">@csrf
                  <button class="btn btn-outline-primary btn-sm">Give Shirt</button>
                </form>
              @endif
            </div>
          </div>
          <form method="POST" action="{{ route('admin.comment',$car) }}" class="mt-2">
            @csrf
            <textarea name="comments" class="form-control" rows="2" placeholder="Add comments…">{{ old('comments',$car->comments) }}</textarea>
            <div class="mt-2">
              <button class="btn btn-outline-secondary btn-sm">Save Comments</button>
            </div>
          </form>
        </div>
      @endforeach
    </div>
  @endif
</div>
</x-app-layout>