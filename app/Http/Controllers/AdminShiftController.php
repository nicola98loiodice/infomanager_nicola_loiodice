<?php

namespace App\Http\Controllers;

use App\Models\ScheduledShift;
use App\Models\User;
use Illuminate\Http\Request;

class AdminShiftController extends Controller
{
    public function index()
    {
        // $users = User::where('role', 'Operatore')->get(); includiamo solo gli operatori se l'admin non deve selezionarsi e quindi non lavorare.
        $users = User::all(); // Admin incluso

        $shifts = ScheduledShift::with('user')->orderBy('date')->get();

        return view('admin.shifts.index', compact('users', 'shifts'));
    }

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

    public function destroy($id)
    {
        $shift = ScheduledShift::findOrFail($id);
        $shift->delete();

        return redirect()->back();
    }


    // pagina index operatori per admin
    public function users()
    {
        // $users = User::where('role', 'Operatore')->get();
        $users = User::all(); // Admin incluso
        $totals = [];

        foreach ($users as $user) {
            $minutes = ScheduledShift::where('user_id', $user->id)
                ->where('is_signed', true)
                ->sum('minutes');

            $totals[$user->id] = $minutes;
        }
        return view('admin.users.index', compact('users','totals'));
    }
}
