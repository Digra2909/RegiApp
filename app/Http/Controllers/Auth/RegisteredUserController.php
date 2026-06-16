<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // If an authenticated non-admin visits register, redirect them away
        if (Auth::check() && ! (method_exists(Auth::user(), 'hasRole') && Auth::user()->hasRole('admin'))) {
            dd('je suis ici ! ');
            if (\Route::has('dashboard')) {
                return redirect()->route('register');
            }

            return redirect()->route('register');
        }

        $roles = Role::all();

        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Prevent authenticated non-admins from creating users via this route
        if (Auth::check() && ! (method_exists(Auth::user(), 'hasRole') && Auth::user()->hasRole('admin'))) {
            if (\Route::has('dashboard')) {
                return redirect()->route('dashboard');
            }

            return redirect('/');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Attach selected roles from registration (if any)
        if ($request->filled('roles')) {
            $user->assignRole($request->input('roles'));
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('login', absolute: false));
    }
}
