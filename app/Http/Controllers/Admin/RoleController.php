<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Session;
class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('permissions-role')) {

            $roles = Role::all();
            return view('backend.pages.roles')->withRoles($roles);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('permissions-role')) {

            $permissions = Permission::all();
            return view('backend.pages.create_role')->withPermissions($permissions);


        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->can('permissions-role')) {
            $this->validate($request, [
                'display_name' => 'required|max:255',
                'name' => 'required|max:100|alpha_dash|unique:roles,name',
                'description' => 'sometimes|max:255'
            ]);

            $role = new Role;
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();

            if ($request->permissions) {

                $permissions = $request->get('permissions', []);
                $role->syncPermissions($permissions);


            }

            Session::flash('success', 'Successfully update the '. $role->display_name . ' role in the database.');
            return redirect()->route('roles.index');

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->can('permissions-role')) {

            $roles = Role::findOrFail($id);
            return view('backend.pages.role_details')->withRoles($roles);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->can('permissions-role')) {

            $roles = Role::where('id',$id)->with('permissions')->first();
            $permissions = Permission::all();
            return view('backend.pages.edit_roles')->withRoles($roles)->withPermissions($permissions);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Auth::user()->can('permissions-role')) {

            $this->validate($request, [
                'display_name' => 'required|max:255',
                'description' => 'sometimes|max:255'
            ]);

            $role = Role::findOrFail($id);
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();

            if ($request->permissions) {

                $permissions = $request->get('permissions', []);
                $role->syncPermissions($permissions);


            }

            Session::flash('success', 'Successfully update the '. $role->display_name . ' role in the database.');
            return redirect()->route('roles.show', $id);


        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
