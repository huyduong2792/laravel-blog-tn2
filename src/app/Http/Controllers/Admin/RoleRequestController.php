<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleRequest;
use App\Http\Requests\Admin\RoleRequestRequest;
use Illuminate\Http\RedirectResponse;

class RoleRequestController extends Controller
{

    public function update(RoleRequestRequest $request, RoleRequest $roleRequest): RedirectResponse
    {
        $role = $roleRequest->role;
        $this->authorize('approveRole', auth()->user(), $role->name);
        $action = $request->input('action');
        $user_request = $roleRequest->user;

        if ($action === 'approve') {
            $roleRequest->update(['status' => 'approved']);
            $user_request->roles()->attach($role->id);
        } elseif ($action === 'reject') {
            $roleRequest->update(['status' => 'rejected']);
            $user_request->roles()->detach($role->id);
        }
        return redirect()->route('admin.users.edit', $user_request)->withSuccess(__('users.role_request_updated'));
    }

}