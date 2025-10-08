<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shift;


class UserController extends Controller
{
    public function show(){
        $user = Auth::user();
        $shifts = $user->shifts()->latest()->get();
        $totaleOre = round($shifts->sum('minutes')/60,2);
        return view('profile.show', compact('user','shifts','totaleOre'));
    }
}
