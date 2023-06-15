<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function create () {
        return view('admin.permission.add');
    }

    public function store (StorePermissionRequest $request) 
    {
        $permission = Permission::create([
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0
        ]);
        if (!empty($request->module_children)) {
            foreach ($request->module_children as $value) {
                Permission::create([
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $permission->id,
                    'key_code' => $value . '_' . $request->module_parent,
                ]);
            }
        }

    }
}
