<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
<<<<<<< HEAD
=======
    /**
     * Tampilkan form register.
     */
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
    public function show()
    {
        return view('auth.register');
    }

<<<<<<< HEAD
=======
    /**
     * Simpan user baru.
     */
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

<<<<<<< HEAD
        $role = 'user';

        if (
            $request->filled('admin_code') &&
            $request->admin_code =="ADMIN123"
        ) {
            $role = 'admin';
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}
=======
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // ✅ default user
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
