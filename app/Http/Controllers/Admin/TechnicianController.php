<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\CreateTechnician;
use App\Actions\Admin\DeleteTechnician;
use App\Actions\Admin\EditTechnician;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicianRequest;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technicians = User::role('technician')->get();

        return view('dashboard.admin.technician.index', compact('technicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.technician.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnicianRequest $request, CreateTechnician $action)
    {
        $data = $request->validated();
        $action->handle($data);

        return to_route('technician.index')->with('success', 'Successfully created a new technician');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.admin.technician.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnicianRequest $request, User $user, EditTechnician $action)
    {
        $data = $request->validated();
        $action->handle($user, $data);

        return to_route('technician.index')->with('success', 'Successfully edited a technician');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, DeleteTechnician $action)
    {
        $action->handle($user);

        return to_route('technician.index')->with('success', 'Successfully deleted a technician');
    }
}
