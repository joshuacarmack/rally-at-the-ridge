<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function search(Request $r)
    {
        $q = trim((string)$r->query('q',''));
        $cars = collect();

        if ($q !== '') {
            $cars = Car::query()
                ->when(is_numeric($q), fn($qq) => $qq->where('id', (int)$q)) // ticket == id
                ->when(!is_numeric($q), fn($qq) =>
                    $qq->whereFullText(['first_name','last_name'],$q)
                       ->orWhere('last_name','like',"%$q%")
                       ->orWhere('first_name','like',"%$q%"))
                ->orderBy('last_name')->orderBy('first_name')
                ->limit(50)->get();
        }

        return view('admin.search', compact('q','cars'));
    }

    public function checkin(Request $r, Car $car)
    {
        if ($car->checked_in) return back()->with('ok','Already checked in');

        $validated = $r->validate(['comments' => 'nullable|max:2000']);
        $car->update([
            'checked_in'    => true,
            'checked_in_at' => now(),
            'checked_in_by' => optional($r->user())->id,
            'comments'      => $validated['comments'] ?? $car->comments,
        ]);

        return back()->with('ok','Checked in');
    }

    public function shirt(Request $r, Car $car)
    {
        $car->update(['tshirt_given' => true]);
        return back()->with('ok','Shirt marked as given');
    }

    public function comment(Request $r, Car $car)
    {
        $validated = $r->validate(['comments' => 'nullable|max:2000']);
        $car->update(['comments' => $validated['comments'] ?? null]);
        return back()->with('ok','Comments saved');
    }
}
