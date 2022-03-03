<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Role;
use Facade\FlareClient\Flare;

class UsersPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
    public function viewAny()
    {
        // return true;
    }


    public function view()
    {

        return $this->getPermission()->contains('User_list');

    }


    public function create()
    {
        // return true;
        return $this->getPermission()->contains('User_create');
    }


    public function update()
    {
        return $this->getPermission()->contains('User_update');
    }


    public function delete()
    {
        return $this->getPermission()->contains('User_delete');

    }


    public function restore()
    {
        //
    }


    public function forceDelete()
    {
        //
    }

    public function getPermission()
    {
        $role_id =  User::with('roles')->find(session()->get('user')->id)->roles->pluck('id')->toArray();
        $permissions =  Role::with('permissions')->whereIn('id', $role_id)->get()->pluck('permissions');
        foreach ($permissions as $permission) {
            $permissionArray[] =  $permission->pluck('name');
        }
        $permissionsId =  collect($permissionArray)->collapse()->unique();
        return $permissionsId;
    }
}
