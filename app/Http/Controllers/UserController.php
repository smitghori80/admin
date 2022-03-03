<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public $storeDataType;

    function __construct()
    {
        // $this->middleware('permission:user-list', ['only' => ['index']]);
        // $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->storeDataType = Setting::whereIn('name', ['store_data_type'])->get()->pluck('value');

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {

            $data = User::with('roles')->select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit = route('user.edit',['id' => $row->id]);
                    return (Auth::user()->can('user-edit') == '') ? '' : "&emsp;<a href={$edit} title='EDIT' class='btn btn-warning'><i class='fas fa-edit'></i></a>";

                })
                ->addColumn('delete', function ($row) {
                    return (Auth::user()->can('user-delete') == '') ? '' : "&emsp;<a href='javascript:void(0)' onclick='deleteUser({$row->id})' title='SHOW' class='btn btn-danger mx-3'><i class='far fa-trash-alt'></i></a>";

                })->addColumn('image', function ($row) {
                    $src =  $row->image ? asset('storage/user/' . $row->image) : asset('/assets/images/users/1.jpg');
                    return  "<img src={$src}  class='brand-image img-circle elevation-3' style='height: 70px; width: 70px'   alt='no image'>";

                })->addColumn('status', function ($row) {
                    return  ($row->status == 1) ? 'active' : 'inactive';

                })->addColumn('roles', function ($row) {
                    return $row->roles->pluck('name')->implode(',');

                })->addColumn('created_at', function ($row) {
                    return date('j M Y h:i a', strtotime($row->created_at));

                })
                ->rawColumns(['edit', 'delete','image','status','created_at'])
                ->make(true);
        }

        return view('user.list');
    }


    public function create()
    {
        if ($this->storeDataType->contains("api"))
        {
            $response  = Http::get(env('NGROK').'/smit/ADMIN/public/api/index');
            $countries = collect(json_decode($response));

            return view('user.create', compact('countries'));
        }
        else
        {
            $countries = Countries::all();
            return view('user.create', compact('countries'));
        }
    }


    public function store(Request $request)
    {

        if ($this->storeDataType->contains("api"))
        {
            $imageName = $request->file('image');
            $input = $request->except('image');
            if (!$request->hobbies)
            {
                return back()->with('error', 'Select at least one hobbie');
            }

            if (!$request->role)
            {
                return back()->with('error', 'Select at least one role');
            }

            $input['hobbies'] = implode(",", $request->get('hobbies'));
            $input['role'] = implode(",", $request->get('role'));
            if ($request->hasFile('image'))
            {
                $response = Http::attach('attachment', file_get_contents($imageName), 'image.jpg')
                    ->post(env('NGROK').'/smit/ADMIN/public/api/create', $input);
            }
            else
            {
                $response = Http::post(env('NGROK').'/smit/ADMIN/public/api/create', $input);
            }

            if ($response->status() == 403)
            {
                return redirect(route('user.create'))->withErrors($response->json());
            }

            if ($response->status() == 200)
            {
                return redirect(route('user.list'))->with('success', 'Data Add successfully!');
            }
            else
            {
                return back()->with('error', 'unexpected error');
            }
        }
        else
        {
            $request->validate([
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

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = md5($request->password_confirmation);
            $user->gender = $request->gender;
            $hobbies = implode(",", $request->input('hobbies'));
            $user->hobbies = $hobbies;
            $user->state_id = $request->state;
            $user->countrie_id = $request->countrie;
            $user->status = 0;
            $user->city = $request->city;
            $user->save();
            if ($request->image !== null)
            {
                $imageName = $request->file('image');
                $newName =  'profile_' . $user->id . '.' . $imageName->getClientOriginalExtension();
                $imageName->move(public_path('storage\user'), $newName);
                $user->image = $newName;
            }
            $user->status = 1;
            $user->save();
            $user->roles()->attach($request->role);

            return redirect(route('user.list'))->with('success', 'user add');
        }
    }


    public function edit($id)
    {

        if ($this->storeDataType->contains("api"))
        {
            $response = Http::get(env('NGROK').'/smit/ADMIN/public/api/edit', ['id' => $id]);
            $data = json_decode($response);
            return view('user.edit', ['countries' => $data->countries, 'user' => $data->user]);
        }
        else
        {
            $countries = Countries::all();
            $user = User::find($id);
            return view('user.edit', compact('countries', 'user'));
        }
    }


    public function update(Request $request)
    {

        if ($this->storeDataType->contains("api"))
        {
            if (!$request->hobbies)
            {
                return back()->with('error', 'Select at least one hobbie');
            }

            if (!$request->role) {
                return back()->with('error', 'Select at least one role');
            }

            $imageName = $request->file('image');
            $input = $request->except('image');
            $input['hobbies'] = implode(",", $request->get('hobbies'));
            $input['role'] = implode(",", $request->get('role'));

            if ($request->hasFile('image'))
            {
                $response = Http::attach('attachment', file_get_contents($imageName), 'image.jpg')
                    ->post(env('NGROK').'/smit/ADMIN/public/api/update', $input);
            }
            else
            {
                $response = Http::post(env('NGROK').'/smit/ADMIN/public/api/update', $input);
            }

            if ($response->status() == 403)
            {
                return back()->withErrors($response->json());
            }

            if ($response->status() == 200) {
                return redirect(route('user.list'))->with('success', 'User data edit successfully!');
            }
            else
            {
                return back()->with('error', 'unexpected error');
            }

        }
        else
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password_confirmation' => 'same:password',
                'gender' => 'required',
                'state_id' => 'required',
                'city' => 'required',
                'countrie_id' => 'required',
                'hobbies' => 'required',
                'role' => 'required',
            ]);

            $user =  User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password_confirmation != '')
            {
                $user->password = md5($request->password_confirmation);
            }
            $user->gender = $request->gender;
            $hobbies = $request->input('hobbies');
            $hobbies = implode(",", $hobbies);
            $user->hobbies = $hobbies;
            $user->state_id = $request->state_id;
            $user->countrie_id = $request->countrie_id;
            $user->city = $request->city;
            $user->save();
            if ($request->hasfile('image'))
            {
                $imageName = $request->file('image');
                $newName =  'profile_' . $user->id . '.' . $imageName->getClientOriginalExtension();
                $imageName->move(public_path('storage\user'), $newName);
            }
            else
            {
                $newName = $request->images;
            }
            $user->image = $newName;
            $user->save();

            $user->roles()->detach();
            $user->roles()->attach($request->role);

            return redirect(route('user.list'))->with('success', 'User data edit successfully!');
        }
    }


    public function destroy(Request $request)
    {

        // $this->authorizeForUser(session()->get('user'), 'delete', session()->get('user'));
        // if (! Gate::forUser(session()->get('user'))->allows('delete_user', $this->getPermission())) {
        //     return back()->with('error','This page not access');
        // }

        if ($this->storeDataType->contains("api"))
        {
            $response = Http::delete(env('NGROK').'/smit/ADMIN/public/api/delete', $request->all());
            return $response->json();
        }
        else
        {
            $id = $request->id;
            $user = User::find($id);
            User::destroy($id);
            $user->roles()->detach();

            return response()->json([
                'client' => $id,
            ]);
        }
    }

    public function state(Request $request)
    {
        if ($this->storeDataType->contains("api"))
        {
            $response  = Http::get(env('NGROK').'/smit/ADMIN/public/api/state', $request->all());
            $state = collect(json_decode($response));
            return response()->json([
                'state' => $state,
            ]);
        }
        else
        {
            $state =  Countries::find($request->id)->state;
            return response()->json([
                'state' => $state,
            ]);
        }
    }

    public function role(Request $request)
    {
        $role = Role::select('id as id', 'name as text')
            ->where('name', 'like', '%' . $request->searchTerm . '%')
            ->get();

        return response()->json($role);
    }
}
