<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Drawing;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DrawingController extends Controller
{
    public function index()
    {
        $unclaimed = Drawing::with('car')->where('claimed',false)->latest()->get();
        $history   = Drawing::with('car')->latest()->limit(50)->get();
        return view('admin.drawings', compact('unclaimed','history'));
    }

    public function draw(Request $r)
    {
        $winner = Car::where('is_test', false)
            ->where('checked_in', true)
            ->where('prize_drawn', false)
            ->inRandomOrder()
            ->first();

        if (!$winner) return back()->with('err','No eligible entries.');

        DB::transaction(function () use ($winner, $r) {
            $winner->update(['prize_drawn'=>true]);
            Drawing::create([
                'user_id' => optional($r->user())->id,
                'car_id'  => $winner->id,
                'claimed' => false,
            ]);
        });

        return back()->with('ok',"Winner: {$winner->first_name} {$winner->last_name} (Ticket {$winner->id})");
    }

    public function claim(Drawing $drawing)
    {
        $drawing->update(['claimed' => true]);
        $drawing->car?->update(['prize_claimed' => true]);
        return back()->with('ok','Marked claimed.');
    }
}
