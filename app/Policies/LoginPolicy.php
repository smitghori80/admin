<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoginPolicy
{
    use HandlesAuthorization;


    public function create()
    {

        //Return true if a user has permission to create-user
        return true;
    }


    public function update()
    {
        return true;

        //Return true if the authenticated user has the same id with specified model/user id
        //or has permission to update-user
        // return $authenticatedUser->id === $user->id || $authenticatedUser->permissions()->contains('update-user');
    }


    public function delete()
    {
        return true;

        //Return true if an authenticated user has permission to delete-user
        // return $user->permissions()->contains('delete-user');
    }

}
