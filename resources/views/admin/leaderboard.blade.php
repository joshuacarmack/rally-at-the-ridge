<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leaderboard (Top 15)</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket (ID)</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Votes</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checked In</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-100">
            @foreach($top as $i => $row)
              <tr>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $i+1 }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $row['car_id'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $row['name'] }}</td>
                <td class="px-4 py-2 text-sm font-semibold text-gray-900">{{ $row['votes'] }}</td>
                <td class="px-4 py-2">
                  @if($row['checked_in'])
                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Yes</span>
                  @else
                    <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700">No</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <h3 class="mt-8 text-sm font-semibold text-gray-700">Votes for Not‑Checked‑In Cars</h3>
      @if($notChecked->isEmpty())
        <p class="text-gray-600 mt-1">None 🎉</p>
      @else
        <ul class="mt-2 space-y-1">
          @foreach($notChecked as $row)
            <li class="text-sm text-gray-700">Ticket {{ $row['car_id'] }} — {{ $row['name'] }} ({{ $row['votes'] }} votes)</li>
          @endforeach
        </ul>
      @endif

      @if(isset($testVotes) && $testVotes->isNotEmpty())
        <h3 class="mt-8 text-sm font-semibold text-gray-700">TEST Cars (training only)</h3>
        <ul class="mt-2 space-y-1">
          @foreach($testVotes as $row)
            <li class="text-sm text-gray-700">Ticket {{ $row['car_id'] }} — {{ $row['name'] }} ({{ $row['votes'] }} votes)
              <span class="ml-2 inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">TEST</span>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</x-app-layout>
