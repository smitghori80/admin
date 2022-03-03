<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleStoreRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:role-list', ['only' => ['index']]);
        // $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        if ($request->ajax())
        {
            $data = Role::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('role.edit',['id' => $row->id]);
                    return (Auth::user()->can('user-edit') == '') ? '' : "&emsp;<a href={$edit} title='EDIT'><span class='glyphicon glyphicon-edit btn btn-warning'><i class='fas fa-edit'></i></span></a>";

                })->addColumn('delete', function ($row) {
                    return (Auth::user()->can('user-delete') == '') ? '' : "&emsp;<a href='javascript:void(0)' onclick='deleteRole({$row->id})' title='SHOW' class='btn btn-danger'><i class='far fa-trash-alt'></i></a>";

                })
                ->rawColumns(['action', 'delete'])
                ->make(true);
        }

        return view('role.list');
    }


    public function create()
    {

        $permissions = Permission::all();

        return view('role.create', compact( 'permissions', ));

    }


    public function store(RoleStoreRequest $request)
    {

        $request->validated();

        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permission);

        return redirect(route('role.list'))->with('success', 'role add');
    }


    public function edit($id)
    {
        $roles = Role::with('permissions')->find($id);
        $permissions_id = $roles->permissions->pluck('id')->toArray();
        $permissions = Permission::all();

        return view('role.edit', compact('roles', 'permissions', 'permissions_id'));

    }


    public function update(RoleStoreRequest $request, $id)
    {
        $request->validated();

        Role::where('id', $id)->update(['name' => $request->name]);
        $role = Role::find($id);
        $role->syncPermissions($request->permission);

        return redirect(route('role.list'))->with('success', 'role data edit');
    }


    public function destroy(Request $request)
    {

        Role::destroy($request->id);

        return response()->json(['delete']);

    }

}
