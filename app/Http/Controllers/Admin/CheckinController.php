<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    // Table search: empty query = list all (paginated)
    public function index(Request $r)
    {
        $q = trim((string)$r->query('q',''));

        $cars = Car::query()
            ->when($q !== '', function ($qq) use ($q) {
                if (is_numeric($q)) {
                    $qq->where('id', (int)$q);
                } else {
                    $qq->where(function ($w) use ($q) {
                        $w->whereFullText(['first_name','last_name'], $q)
                          ->orWhere('first_name','like',"%{$q}%")
                          ->orWhere('last_name','like',"%{$q}%");
                    });
                }
            })
            ->orderBy('last_name')->orderBy('first_name')->orderBy('id')
            ->paginate(25)
            ->withQueryString();

        return view('admin.checkin_index', compact('q','cars'));
    }

    // Detail page
    public function show(Car $car)
    {
        return view('admin.checkin_show', compact('car'));
    }

    // Actions
    public function checkin(Request $r, Car $car)
    {
        if (!$car->checked_in) {
            $validated = $r->validate(['comments' => 'nullable|max:2000']);
            $car->update([
                'checked_in'    => true,
                'checked_in_at' => now(),
                'checked_in_by' => optional($r->user())->id,
                'comments'      => $validated['comments'] ?? $car->comments,
            ]);
        }
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
