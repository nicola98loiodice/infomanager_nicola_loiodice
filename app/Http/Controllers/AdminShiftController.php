<?php

namespace App\Http\Controllers;

use App\Models\ScheduledShift;
use App\Models\User;
use Illuminate\Http\Request;

class AdminShiftController extends Controller
// Doveva essere solo un controller dedicato al controllo dei turni ma è diventato un mischione di roba. Trovi un po' di tutto di quello che può fare l'admin
{
    // funzione per indice dei turni
    public function index()
    {
        // $users = User::where('role', 'Operatore')->get(); includiamo solo gli operatori se l'admin non deve selezionarsi e quindi non lavorare.
        $users = User::all(); // Admin incluso

        $shifts = ScheduledShift::with('user')->orderBy('date')->get();

        return view('admin.shifts.index', compact('users', 'shifts'));
    }
    // funzione schedulazione turni
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'minutes' => 'required|integer|in:150,180',
            'shift_type' => 'required|string|in:Mattina,Pomeriggio',
        ]);

        ScheduledShift::create($request->only(['user_id', 'date', 'minutes', 'shift_type']));

        return redirect()->back()->with('success', 'Turno aggiunto con successo!');
    }
    // funzione per eliminare i turni schedulati per errore dall'admin
    public function destroy($id)
    {
        $shift = ScheduledShift::findOrFail($id);
        $shift->delete();

        return redirect()->back();
    }


    // pagina index operatori per admin
    public function users(Request $request)
    {

        $start = $request->input('start_date', now()->startOfMonth()->toDateString());
        $end = $request->input('end_date', now()->endOfMonth()->toDateString());

        // $users = User::where('role', 'Operatore')->get();
        $users = User::all(); // Admin incluso
        $totals = [];
        $rangeTotals = [];
        $hourlyRate = 10;

         foreach ($users as $user) {
        //ore complessive
        $totals[$user->id] = ScheduledShift::where('user_id', $user->id)
            ->where('is_signed', true)
            ->sum('minutes');

        //ore filtrate dal range impostato nel form
        $rangeTotals[$user->id] = ScheduledShift::where('user_id', $user->id)
            ->where('is_signed', true)
            ->whereBetween('date', [$start, $end])
            ->sum('minutes');
        // calcolo paga per ore in range
        $rangeTotalsInEuros[$user->id] = ($rangeTotals[$user->id] / 60) * $hourlyRate;
    }
    return view('admin.users.index', compact('users', 'totals', 'start', 'end','rangeTotals','rangeTotalsInEuros','hourlyRate'));
    }
}
