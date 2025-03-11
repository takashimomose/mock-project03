<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function show()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function showVerifyEmailNotice()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if (! hash_equals((string) $request->route('hash'), sha1($user->email))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email verification link.',
            ]);
        }

        $user->markEmailAsVerified();

        return redirect()->route('auth.show')->with('verified', true);
    }


    public function store(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'ログイン情報が登録されていません',
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role_id != User::ROLE_GENERAL) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => '利用者以外のユーザーはログインできません',
            ]);
        }

        $user = Auth::user();

        if (is_null(Auth::user()->email_verified_at)) {
            event(new Registered($user));

            Auth::logout();
            return redirect()->route('register.thanks');
        }

        return redirect()->intended('/');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showOwner()
    {
        return view('auth.owner_login');
    }

    public function storeOwner(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'ログイン情報が登録されていません',
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role_id != User::ROLE_OWNER) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => '店舗代表者以外のユーザーはログインできません',
            ]);
        }

        return redirect()->intended('/owner/shop/create');
    }

    public function destroyOwner(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/owner/login');
    }

    public function showAdmin()
    {
        if (auth()->check()) {
            return redirect()->route('owner.index');
        }

        return view('auth.admin_login');
    }

    public function storeAdmin(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'ログイン情報が登録されていません',
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role_id != User::ROLE_ADMIN) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => '管理者以外のユーザーはログインできません',
            ]);
        }

        return redirect()->intended('/admin/owners');
    }

    public function destroyAdmin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
