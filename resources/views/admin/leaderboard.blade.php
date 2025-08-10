@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1>Leaderboard (Top 15)</h1>
  <table class="table table-striped">
    <thead><tr><th>#</th><th>Ticket (ID)</th><th>Name</th><th>Votes</th><th>Checked In</th></tr></thead>
    <tbody>
      @foreach($top as $i => $row)
        <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $row['car_id'] }}</td>
          <td>{{ $row['name'] }}</td>
          <td>{{ $row['votes'] }}</td>
          <td>{!! $row['checked_in'] ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-warning">No</span>' !!}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h3 class="mt-4">Votes for Not‑Checked‑In Cars</h3>
  @if($notChecked->isEmpty())
    <p>None 🎉</p>
  @else
    <ul>
      @foreach($notChecked as $row)
        <li>Ticket {{ $row['car_id'] }} — {{ $row['name'] }} ({{ $row['votes'] }} votes)</li>
      @endforeach
    </ul>
  @endif

  @if(isset($testVotes) && $testVotes->isNotEmpty())
    <h3 class="mt-4">TEST Cars (training only)</h3>
    <ul>
      @foreach($testVotes as $row)
        <li>Ticket {{ $row['car_id'] }} — {{ $row['name'] }} ({{ $row['votes'] }} votes) <span class="badge bg-secondary">TEST</span></li>
      @endforeach
    </ul>
  @endif
</div>
@endsection
