<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    //
    public function index()
    {
        $countries = Countries::all();

        return  response()->json($countries);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'countrie' => 'required',
            'city' => 'required',
            'state' => 'required',
            'hobbies' => 'required',
            'role' => 'required',

        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 403);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = md5($request->password_confirmation);
        $user->gender = $request->gender;
        $user->hobbies = $request->hobbies;
        $user->state_id = $request->state;
        $user->countrie_id = $request->countrie;
        $user->status = 0;
        $user->city = $request->city;
        $user->save();
        if ($request->attachment !== null)
        {
            $imageName = $request->file('attachment');
            $newName =  'profile_' .$user->id . '.' . $imageName->getClientOriginalExtension();
            $imageName->move(public_path('storage\user'), $newName);
            $user->image = $newName;
        }
        $user->save();
        $role = explode(',', $request->role);
        $user->roles()->attach($role);

        if ($user)
        {
            return response()->json($user, 200);
        }
        else
        {
            return  response()->json($user, 404);
        }
    }



    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        User::destroy($id);
        $user->roles()->detach();

        return 'success';
    }

    public function edit(Request $request)
    {
        return response()->json([
            'countries' => Countries::all(),
            'user' => User::with('roles')->find($request->id)
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'password_confirmation' =>  'same:password',
            'countrie_id' => 'required',
            'city' => 'required',
            'state_id' => 'required',
            'hobbies' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 403);
        }

        $user =  User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password_confirmation != '')
        {
            $user->password = md5($request->password_confirmation);
        }
        $user->gender = $request->gender;

        $user->hobbies = $request->hobbies;
        $user->state_id = $request->state_id;
        $user->countrie_id = $request->countrie_id;
        $user->city = $request->city;
        $user->save();
        if ($request->attachment !== null)
        {
            $imageName = $request->file('attachment');
            $newName =  'profile_' .$user->id . '.' . $imageName->getClientOriginalExtension();
            $imageName->move(public_path('storage\user'), $newName);
            $user->image = $newName;
        }
        $user->save();
        $user->roles()->detach();
        $role = explode(',', $request->role);
        $user->roles()->attach($role);

        if ($user)
        {
            return response()->json($user, 200);
        }
        else
        {
            return  response()->json($user, 404);
        }
    }

    public function role(Request $request)
    {
        $role = Role::select('id as id', 'name as text')
            ->where('name', 'like', '%' . $request->searchTerm . '%')
            ->get();

        return $role;
    }

    public function state(Request $request)
    {
        $state =  Countries::find($request->id)->state;

        return response()->json($state);
    }
}
