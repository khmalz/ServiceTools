<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Display view inbox.
     */
    public function index(Request $request)
    {
        $notifications = DatabaseNotification::whereJsonContains('data->type', 'reschedule')
            ->whereJsonContains('data->client_user_id', $request->user()->id)
            ->where(function ($query) {
                $query->whereDate('created_at', '>=', now())
                    ->orWhere(function ($query) {
                        $query->whereDate('created_at', '<=', now())
                            ->whereNull('read_at');
                    });
            })->oldest('read_at')->oldest()->get();

        return view('notification', compact('notifications'));
    }

    /**
     * Read all or specified notification
     */

    public function read(Request $request, ?string $id = null)
    {
        DatabaseNotification::whereJsonContains('data->type', 'reschedule')
            ->whereJsonContains('data->client_user_id', $request->user()->id)->when($id, function ($query) use ($id) {
                $query->find($id);
            })->update(['read_at' => now()]);

        return to_route('notification.index');
    }
}
