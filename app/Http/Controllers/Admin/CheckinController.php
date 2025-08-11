<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CheckinController extends Controller
{
    /**
     * Table search: empty query = list all (paginated)
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $cars = Car::query()
            ->when($q !== '', function ($query) use ($q) {
                if (is_numeric($q)) {
                    $query->where('id', (int) $q); // ticket == id
                } else {
                    $query->where(function ($w) use ($q) {
                        $w->where('first_name', 'like', "%{$q}%")
                          ->orWhere('last_name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%")
                          ->orWhere('phone', 'like', "%{$q}%")
                          ->orWhere('make', 'like', "%{$q}%")
                          ->orWhere('model', 'like', "%{$q}%");
                    });
                }
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('id')
            ->paginate(25)
            ->withQueryString();

        return view('admin.checkin_index', compact('cars', 'q'));
    }

    /**
     * Detail page
     */
    public function show(Car $car)
    {
        return view('admin.checkin_show', compact('car'));
    }

    /**
     * One-form submit: shirt checkbox + comments + (first-time) check-in
     */
    public function checkin(Request $request, Car $car)
    {
        $data = $request->validate([
            'comments'     => 'nullable|string|max:2000',
            'tshirt_given' => 'nullable|boolean',
        ]);

        // Update comments + shirt
        $car->comments = $data['comments'] ?? $car->comments;
        $car->tshirt_given = $request->boolean('tshirt_given'); // checked => true

        // Mark checked-in if not already
        if (! $car->checked_in) {
            $car->checked_in    = true;
            $car->checked_in_at = now();
            $car->checked_in_by = optional($request->user())->id;
        }

        $car->save();

        // NOTE: route name is admin.cars.show per your routes
        return redirect()->route('admin.cars.show', $car)->with('ok', 'Check-in updated.');
    }
}
