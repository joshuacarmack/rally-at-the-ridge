<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Vote;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    public function index()
    {
        return view('admin.voting');
    }

    public function submit(Request $r)
    {
        $data = $r->validate(['numbers' => 'required|string']); // e.g. "12 45 118"
        $ids = collect(preg_split('/[\s,;]+/', trim($data['numbers'])))->filter()->map(fn($n)=> (int)$n)->values();
        if ($ids->isEmpty()) return back()->with('err','Enter at least one number.');

        $validIds = Car::whereIn('id', $ids)->pluck('id')->all();
        $invalid  = $ids->diff($validIds)->values();

        DB::transaction(function () use ($validIds, $r) {
            foreach ($validIds as $carId) {
                Vote::create([
                    'car_id'   => $carId,
                    'added_by' => optional($r->user())->id,
                ]);
            }
        });

        $msg = "Recorded ".count($validIds)." vote(s).";
        if ($invalid->isNotEmpty()) $msg .= " Invalid IDs: ".$invalid->implode(', ')." (review).";
        return back()->with('ok',$msg);
    }

    public function leaderboard()
    {
        // Main leaderboard excludes TEST cars
        $top = Vote::join('cars','votes.car_id','=','cars.id')
            ->where('cars.is_test', false)
            ->selectRaw('votes.car_id, COUNT(*) as votes')
            ->groupBy('votes.car_id')
            ->orderByDesc('votes')
            ->limit(15)
            ->get()
            ->map(function ($row) {
                $car = Car::find($row->car_id);
                return [
                    'car_id'     => $row->car_id,
                    'votes'      => (int)$row->votes,
                    'name'       => $car?->first_name.' '.$car?->last_name,
                    'checked_in' => (bool)($car?->checked_in),
                ];
            });

        $notChecked = $top->filter(fn($x) => $x['checked_in'] === false)->values();

        // Optional: show TEST votes (training)
        $testVotes = Vote::join('cars','votes.car_id','=','cars.id')
            ->where('cars.is_test', true)
            ->selectRaw('votes.car_id, COUNT(*) as votes')
            ->groupBy('votes.car_id')
            ->orderByDesc('votes')
            ->get()
            ->map(function ($row) {
                $car = Car::find($row->car_id);
                return [
                    'car_id' => $row->car_id,
                    'votes'  => (int)$row->votes,
                    'name'   => $car?->first_name.' '.$car?->last_name,
                ];
            });

        return view('admin.leaderboard', compact('top','notChecked','testVotes'));
    }
}
