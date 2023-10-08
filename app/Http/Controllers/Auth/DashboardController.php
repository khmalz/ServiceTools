<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasRole('client')) {
            $user = $request->user()->load('client');

            return view('dashboard.index', compact('user'));
        }

        return view('dashboard.index');
    }
}
