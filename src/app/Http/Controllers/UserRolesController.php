<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequestRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleRequest;

use Illuminate\View\View;


class UserRolesController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        return view('users.roles', [
            'user' => $user,
            'roles' => Role::all()]);
    }

    /**
     * Create a role request for the specified user.
     */
    public function requestRole(RoleRequestRequest $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $roleName = $request->input('role');
        $role = Role::where('name', $roleName)->firstOrFail();

        RoleRequest::firstOrCreate([
            'user_id' => $user->id,
            'role_id' => $role->id,
            'status' => 'pending'
        ]);

        return redirect()->route('users.roles')->withSuccess(__('users.request_submitted'));
    }
}
