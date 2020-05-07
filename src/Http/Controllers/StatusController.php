<?php

namespace Openresources\EmailLogin\Http\Controllers;

use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function index()
    {
        return view('email-login::notification');
    }
}
