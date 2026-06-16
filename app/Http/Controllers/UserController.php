<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\ActivityLog;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $activityLogs = ActivityLog::latest()->with('user')->get();

        return view('Settings.users.index', compact('users', 'activityLogs'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('Settings.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $roles = $request->input('roles', []);
        $permissions = $request->input('permissions', []);

        $user->syncRoles($roles);
        $user->syncPermissions($permissions);

        return redirect()->route('settings.users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('settings.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
