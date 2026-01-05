<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('users')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'permissions' => $request->permissions ?? [],
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('users');
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'permissions' => $request->permissions ?? [],
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Prevent deletion of system roles
        if (in_array($role->name, ['admin', 'teacher', 'student'])) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete system roles.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }

    /**
     * Assign role to user
     */
    public function assignRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = \App\Models\User::find($request->user_id);
        $role = Role::find($request->role_id);

        if ($user->hasRole($role)) {
            return response()->json(['message' => 'User already has this role'], 400);
        }

        $user->assignRole($role);

        return response()->json(['message' => 'Role assigned successfully']);
    }

    /**
     * Remove role from user
     */
    public function removeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = \App\Models\User::find($request->user_id);
        $role = Role::find($request->role_id);

        if (!$user->hasRole($role)) {
            return response()->json(['message' => 'User does not have this role'], 400);
        }

        $user->removeRole($role);

        return response()->json(['message' => 'Role removed successfully']);
    }
}
