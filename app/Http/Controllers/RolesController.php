<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function index(Request $request)
    {

        if (!Gate::allows('View Roles')) {
            abort(401);
        }
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        if (!Gate::allows('Add Roles')) {
            abort(401);
        }
        $permissions = Permission::get();
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $nameParts = explode( ' ', $permission['name']);
            $key = trim($nameParts[1]);

            if (!isset($groupedPermissions[$key])) {
                $groupedPermissions[$key] = [];
            }

            $groupedPermissions[$key][] = $permission;
        }

        return view('roles.create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('Add Roles')) {
            abort(401);
        }
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $permissions=$request->input('permission');
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($permissions);

        return redirect()->route('roles')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        if (!Gate::allows('View Roles')) {
            abort(401);
        }
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        if (!Gate::allows('Edit Roles')) {
            abort(401);
        }
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        $permissions = Permission::get();
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $nameParts = explode( ' ', $permission['name']);
            $key = trim($nameParts[1]);

            if (!isset($groupedPermissions[$key])) {
                $groupedPermissions[$key] = [];
            }

            $groupedPermissions[$key][] = $permission;
        }

        return view('roles.edit', compact('role', 'groupedPermissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('Edit Roles')) {
            abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        if (!Gate::allows('Delete Roles')) {
            abort(401);
        }
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles')
            ->with('success', 'Role deleted successfully');
    }
}
