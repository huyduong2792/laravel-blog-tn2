<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordsRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
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
     * Update password for the specified resource in storage.
     */
    public function update(UserPasswordsRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $user->update($request->only('password'));

        return redirect()->route('users.password')->withSuccess(__('users.password_updated'));
    }
}
