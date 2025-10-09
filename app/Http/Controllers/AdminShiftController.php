<?php

namespace App\Http\Controllers;

use App\Models\ScheduledShift;
use App\Models\User;
use Illuminate\Http\Request;

class AdminShiftController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Operatore')->get();
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

    public function destroy($id){
        $shift = ScheduledShift::findOrFail($id);
        $shift ->delete();

        return redirect()->back();
    }
}
