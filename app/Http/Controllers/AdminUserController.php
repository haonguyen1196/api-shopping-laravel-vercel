<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    use DeleteModelTrait;
    private $user;
    private $role;
    public function __construct (User $user, Role $role) 
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index () 
    {
        $users = $this->user->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create () 
    {   $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store (StoreUserRequest $storeUserRequest) 
    {   try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $storeUserRequest->name,
                'email' => $storeUserRequest->email,
                'password' => Hash::make($storeUserRequest->password)
            ]);
            $user->roles()->attach($storeUserRequest->role_id);
            DB::commit();
            return redirect()->route('admin.user.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage(). 'Line:' . $exception->getLine());
        }
    }

    public function edit ($id) 
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $roleOfUser = $user->roles;
        return view('admin.user.edit', compact('user','roles', 'roleOfUser'));
    }

    public function update ($id, UpdateUserRequest $request) 
    {   
        try {
            DB::beginTransaction();
            $user = $this->user->find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage(). 'Line:' . $exception->getLine());
        }
    }   
    
    public function delete ($id) 
    {
       $data = $this->deleteModelTrait($id, $this->user);
       return $data;
    }
}
