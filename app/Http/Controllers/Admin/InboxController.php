<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display view inbox.
     */
    public function index()
    {
        // $notifications = DatabaseNotification::whereJsonContains('data->role', 'admin')
        //     ->where(function ($query) {
        //         $query->whereDate('created_at', '>=', now())
        //             ->orWhere(function ($query) {
        //                 $query->whereDate('created_at', '<=', now())
        //                     ->whereNull('read_at');
        //             });
        //     })->oldest('read_at')->oldest()->get();

        return view('dashboard.admin.inbox');
    }
}
