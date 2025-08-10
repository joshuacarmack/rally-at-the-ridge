@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1>Voting Entry</h1>
  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
  @if(session('err')) <div class="alert alert-danger">{{ session('err') }}</div> @endif

  <form method="POST" action="{{ route('admin.voting.submit') }}">
    @csrf
    <label class="form-label">Enter up to 3 ticket numbers (IDs), separated by space or comma:</label>
    <input name="numbers" class="form-control" placeholder="e.g. 12 45 118" autofocus>
    <button class="btn btn-primary mt-3">Record Votes</button>
  </form>

  <a href="{{ route('admin.voting.leaderboard') }}" class="btn btn-outline-secondary mt-3">View Leaderboard</a>
</div>
@endsection
