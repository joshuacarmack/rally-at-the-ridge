<x-guest-layout>
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
          <!-- (all your form fields stay exactly the same) -->
        </div>
        <div class="mt-3 d-flex gap-2">
          <button class="btn btn-primary">Submit Registration</button>
          <span class="text-muted">Submitting once is enough—don’t refresh.</span>
        </div>
      </form>
    @endif
  </div>
</x-guest-layout>
