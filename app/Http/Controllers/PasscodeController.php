<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passcode;
use Illuminate\Support\Facades\Redirect;

class PasscodeController extends Controller
{
    public function checkPassword(Request $request)
    {
        $inputPassword = $request->input('password');

        $storedPassword = Passcode::first()->password;
        if ($inputPassword == $storedPassword) {
            return redirect()->route('registerstaff', ['stats' => 'true']);
        } else {
            return Redirect::back()->withErrors(['password' => 'Incorrect password.']);
        }
    }
}
