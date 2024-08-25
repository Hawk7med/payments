<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'Ancien mot de passe incorrect']);
        }

        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('dashboard')->with('success', 'Mot de passe changé avec succès');
    }
}
