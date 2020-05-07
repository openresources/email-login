<?php

namespace Openresources\EmailLogin\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Openresources\EmailLogin\EmailLogin;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    protected function credentials(Request $request)
    {
        return $request->only(
            'password',
            'password_confirmation',
            'token'
        );
    }

    public function reset(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPassword(auth()->user(), $validated['password']);

        $request->session()->flash('status', 'Your password has been created successfully.');

        return redirect()->route('email-login.status');
    }

    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }

    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }

    public function showResetForm(Request $request)
    {
        $emailLogin = EmailLogin::where('email', auth()->user()->email)
            ->where('created_at', '>', Carbon::parse('-15 minutes'))
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$emailLogin) {
            $this->guard()->logout();
            $request->session()->invalidate();
            abort('419', 'Expired token');
        }

        return view('email-login::auth.passwords.reset')->with(
            ['token' => $emailLogin->token, 'email' => auth()->user()->email]
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
