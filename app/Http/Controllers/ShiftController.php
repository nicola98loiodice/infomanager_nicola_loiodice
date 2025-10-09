<?php

namespace App\Http\Controllers;

use App\Models\ScheduledShift;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ShiftController extends Controller
{
    /**
     * Mostra il form di firma turno
     */
    public function create()
    {
        $user = Auth::user();
        $today = now()->toDateString(); // Data odierna dal server
        return view('shifts.create', compact('user', 'today'));
    }

    /**
     * Salva la firma del turno
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();

        // Validazione input
        $request->validate(
            [
                'minutes' => ['required', 'integer', Rule::in([150, 180])],
                'shift_type' => ['required', 'string', Rule::in(['Mattina', 'Pomeriggio'])],
                'lat' => ['required', 'numeric'],
                'lng' => ['required', 'numeric'],
            ],
            [
                'minutes.in' => 'Seleziona un tipo di turno valido (150 o 180 minuti).',
                'shift_type.required' => 'Seleziona la fascia oraria.',
                'lat.required' => 'Posizione non rilevata. Attiva la geolocalizzazione.',
                'lng.required' => 'Posizione non rilevata. Attiva la geolocalizzazione.',
            ]
        );

        // Controllo distanza dalla sede
        $officeLat = config('app.office.lat');
        $officeLng = config('app.office.lng');
        $maxDistance = config('app.office.max_distance_m');
        $distance = $this->distanceInMeters($request->lat, $request->lng, $officeLat, $officeLng);

        if ($distance > $maxDistance) {
            return redirect()->back()->with('error', 'Non sei abbastanza vicino alla sede (max 100 metri).');
        }

        // Controllo che l’utente non abbia già firmato questo turno
        if (Shift::where('user_id', $user->id)
                ->where('date', $today)
                ->where('shift_type', $request->shift_type)
                ->exists()) {
            return redirect()->back()->with('error', 'Hai già firmato questo turno.');
        }

        // Creazione record nella tabella "shifts"
        Shift::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'date' => $today,
            'minutes' => $request->minutes,
            'shift_type' => $request->shift_type,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
        ]);

        // Aggiornamento scheduled_shift se esiste
        $scheduled = ScheduledShift::where('user_id', $user->id)
            ->where('date', $today)
            ->where('shift_type', $request->shift_type)
            ->first();

        if ($scheduled) {
            $scheduled->update(['is_signed' => true]);
        }

        return redirect()->back()->with('success', 'Turno firmato con successo!');
    }

    /**
     * Calcola la distanza in metri tra due punti GPS
     */
    protected function distanceInMeters($lat1, $lng1, $lat2, $lng2): float
    {
        $earthRadius = 6371000; // metri
        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) ** 2 +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lngDelta / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
