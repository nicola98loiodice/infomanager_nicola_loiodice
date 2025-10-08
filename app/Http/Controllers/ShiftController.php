<?php

namespace App\Http\Controllers;

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

//   salva firma
    public function store(Request $request)
    {
        // validazione del tipo di turno (in minuti)
        $request->validate([
            'minutes' => ['required', 'integer', Rule::in([150, 180])],
        ]);

        $user = Auth::user();
        $today = now()->toDateString();

        //verifica che l’utente non abbia già firmato oggi
        if (Shift::where('user_id', $user->id)->where('date', $today)->exists()) {
            return redirect()->back()->with('error', 'Hai già firmato il turno di oggi.');
        }

        // creazione record nel DB (dati presi dal server)
        Shift::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'date' => $today,
            'minutes' => $request->minutes,
        ]);

        // redirect con messaggio di conferma
        return redirect()->back()->with('success', 'Turno firmato con successo!');
    }
}
