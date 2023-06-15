<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
{
    use DeleteModelTrait;
    private $role;
    private $permission;
    public function __construct (Role $role, Permission $permission) 
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index () 
    {
        $roles = $this->role->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create () 
    {
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionParents'));
    }

    public function store (StoreRoleRequest $request) 
    {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('admin.role.index');
    }

    public function edit ($id) 
    {
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions;
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.edit', compact('permissionParents', 'role', 'permissionChecked'));
    }

    public function update (UpdateRoleRequest $request, $id) 
    {
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.role.index');
    }

    public function delete ($id) 
    {
        return $this->deleteModelTrait($id, $this->role);
    }
}
