<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\Auth\LoginRayEmployeeRequest;
use App\Http\Controllers\Controller;
use App\Models\RayEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
class RayEmployeeController extends Controller
{
    //
     public function store(LoginRayEmployeeRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.ray_employee', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('ray_employee')->logout();

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

        $user = RayEmployee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       // event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard.ray_employee', absolute: false));
    }
}


