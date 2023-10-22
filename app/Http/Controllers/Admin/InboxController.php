<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class InboxController extends Controller
{
    /**
     * Display view inbox.
     */
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()
            ->where(function ($query) {
                $query->whereDate('data->schedule', now()->toDateString())
                    ->orWhere(function ($query) {
                        $query->whereDate('created_at', '>=', now())
                            ->orWhere(function ($query) {
                                $query->whereDate('created_at', '<', now())
                                    ->whereNull('read_at');
                            });
                    });
            })
            ->oldest('read_at')
            ->oldest()
            ->get();

        return view('dashboard.admin.inbox', compact('notifications'));
    }

    /**
     * Read all or specified inbox
     */

    public function read(Request $request, ?string $id = null)
    {
        $request->user()->notifications()->when($id, function ($query) use ($id) {
            $query->find($id);
        })->update(['read_at' => now()]);

        return to_route('admin.inbox.index');
    }
}
