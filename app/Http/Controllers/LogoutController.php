<?php

namespace App\Http\Controllers;

use App\Helpers\CartManagement;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        CartManagement::clearCartItemsFromCookie();

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
