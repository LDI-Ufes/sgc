<?php

namespace App\Http\Controllers;

use App\Helpers\SgcLogHelper;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function authenticate(LoginRequest $request)
    {
        $request->validated();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => true])) {
            $request->session()->regenerate();

            SgcLogHelper::writeLog();

            $firstUtaId = auth()->user()->getFirstUta()?->id;
            auth()->user()->setCurrentUta($firstUtaId);

            return redirect()->intended('home');
        }

        SgcLogHelper::writeLog(target: 'System', action: 'tried login', executor: $request);

        return back()->withErrors(['noAuth' => 'Não foi possível autenticar o usuário']);
    }

    public function logout(Request $request)
    {
        SgcLogHelper::writeLog();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('root');
    }
}
