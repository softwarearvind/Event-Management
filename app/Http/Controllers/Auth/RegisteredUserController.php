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
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('auth.register',compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    'role' => ['required'],
]);
 
 $plainPassword = $request->password;

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($plainPassword),
]);

$user->assignRole($request->role);

event(new Registered($user));

Mail::to($user->email)->queue(new WelcomeMail($user, $plainPassword));

Auth::login($user);

if ($user->hasRole('Admin')) {
    return redirect()->route('admin.dashboard');
}

if ($user->hasRole('Manager')) {
    return redirect()->route('manager.index');
}

if ($user->hasRole('User')) {
    return redirect('/');
}
return redirect('/');


    }
}
