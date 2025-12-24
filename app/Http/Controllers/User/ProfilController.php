<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('user.profil.index', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = $request->user();
        $user->password = $request->password;
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}