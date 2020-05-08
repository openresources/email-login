<?php

namespace Openresources\EmailLogin\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Openresources\EmailLogin\EmailLogin;
use Openresources\EmailLogin\Mail\VerifyEmailAddress;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/auth/email-login/password-reset';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function create()
    {
        return view('email-login::auth.email_login');
    }

    protected function credentials(Request $request)
    {
        return $request->only('email');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $emailLogin = EmailLogin::createForEmail($request->email);

        $url = route('email-login.authenticate', $emailLogin->token);

        Mail::to($emailLogin->user)
            ->send(new VerifyEmailAddress($url, $emailLogin->user->name))
        ;

        $request->session()->flash('status', 'A verification email has been sent to the email address you provided.');

        return view('email-login::notification');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|exists:users',
        ]);
    }

    public function authenticate(Request $request, String $token)
    {
        $emailLogin = EmailLogin::fromToken($token)->first();
        if (!$emailLogin) {
            abort('419', 'Expired token');
        }

        $user = $emailLogin->user;

        Auth::login($user);
        $emailLogin->markEmailAsVerified($user);

        $request->session()->flash('status', __('Your email address has been verified. Please set your account password to continue'));

        return redirect()->route('email-login.password.reset');
    }
}
