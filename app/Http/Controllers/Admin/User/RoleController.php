<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\Permission;
use App\Models\Admin\User\Role;
use Illuminate\Http\Request;
use function view;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.user.role.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('layouts.admin.user.role.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.role.index')
            ->with('success', 'New Role Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('layouts.admin.user.role.show', ['role' => $role , 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update(
            [
                'name' => $request->name,
                'description' => $request->description

            ]
        );

        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.role.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.role.index')
            ->with('success', 'Role deleted successfully.');
    }
}

