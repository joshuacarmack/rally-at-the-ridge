@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1>Ridgeview Car Show Registration</h1>

  @if(!$open)
    <div class="alert alert-warning mt-3">
      Registration isn’t open yet. Please check back later.
    </div>
  @else
    <form method="POST" action="{{ route('reg.store') }}" class="mt-3">
      @csrf
      <input type="hidden" name="submission_token" value="{{ $token }}">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">First name</label>
          <input name="first_name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Last name</label>
          <input name="last_name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input name="phone" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label">Vehicle Type</label>
          <select name="vehicle_type" class="form-select">
            <option value="">Select…</option>
            @foreach(['car','truck','motorcycle','other'] as $t)
              <option value="{{ $t }}">{{ ucfirst($t) }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">Year</label>
          <input name="year" type="number" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label">Make</label>
          <input name="make" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label">Model</label>
          <input name="model" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label">Color</label>
          <input name="color" class="form-control">
        </div>

        <div class="col-md-3">
          <label class="form-label">T‑Shirt Size</label>
          <select name="tshirt_size" class="form-select">
            <option value="">N/A</option>
            @foreach(['S','M','L','XL','2XL','3XL'] as $s)
              <option value="{{ $s }}">{{ $s }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Home Church</label>
          <input name="home_church" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label"># in Party</label>
          <input name="party_size" type="number" min="0" class="form-control" value="0">
        </div>

        <div class="col-12">
          <label class="form-label">Comments</label>
          <textarea name="comments" class="form-control" rows="2"></textarea>
        </div>
      </div>

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Submit Registration</button>
        <span class="text-muted">Submitting once is enough—don’t refresh.</span>
      </div>
    </form>
  @endif
</div>
@endsection
