<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'role_id' => User::ROLE_GENERAL,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('register.thanks');
    }

    public function thanks()
    {
        return view('register_thanks');
    }

    public function createOwner()
    {
        return view('auth.owner_create');
    }

    public function storeOwner(RegisterRequest $request)
    {
        User::create([
            'role_id' => User::ROLE_OWNER,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('owner.index', ['success' => 'true']);
    }

    public function destroyOwner($userId)
    {
        User::deleteOwner($userId);

        return response()->json(['success' => true]);
    }
}
