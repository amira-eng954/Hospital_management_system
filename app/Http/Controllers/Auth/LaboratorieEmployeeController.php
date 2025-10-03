<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\Auth\LoginLaboratoieEmployeeReques;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;

class LaboratorieEmployeeController extends Controller
{
    
public function store(LoginLaboratoieEmployeeReques $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.laboratorie_employee', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('laboratorie_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }



     public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required'],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       // event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard.laboratorie_employee', absolute: false));
    }
}

