<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
class PermissionController extends Controller
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

            $permissions = Permission::all();
            return view('backend.pages.permissions')->withPermissions($permissions);

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

            return view('backend.pages.create_permissions');

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->can('permissions-role')) {

            if ($request->permission == 'basic') {
                $this->validate($request, [
                    'display_name' => 'required|max:255',
                    'name' => 'required|max:255|alphadash|unique:permissions,name',
                    'description' => 'sometimes|max:255'
                ]);

                $permission = new Permission();
                $permission->name = $request->name;
                $permission->display_name = $request->display_name;
                $permission->description = $request->description;
                $permission->save();

                Session::flash('success', 'Permission has been successfully added');
                return redirect()->route('permissions.index');

            } elseif ($request->permission == 'crud') {
                $this->validate($request, [
                    'resource' => 'required|min:3|max:100|alpha'
                ]);

                $crud = explode(',', $request->crud_selected);
                if (count($crud) > 0) {
                    foreach ($crud as $x) {
                        $slug = strtolower($x) . '-' . strtolower($request->resource);
                        $display_name = ucwords($x . " " . $request->resource);
                        $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);

                        $permission = new Permission();
                        $permission->name = $slug;
                        $permission->display_name = $display_name;
                        $permission->description = $description;
                        $permission->save();
                    }
                    Session::flash('success', 'Permissions were all successfully added');
                    return redirect()->route('permissions.index');
                }
            } else {
                return redirect()->route('permissions.create')->withInput();
            }

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('permissions-role')) {

            $permissions = Permission::findOrFail($id);
            return view('backend.pages.edit_permissions')->withPermissions($permissions);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Auth::user()->can('permissions-role')) {

            $this->validate($request, [
                'display_name' => 'required|max:255',
                'description' => 'sometimes|max:255'
            ]);
            $permission = Permission::findOrFail($id);
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->save();

            Session::flash('success', 'Ndryshimet perfunduan me sukses ');
            return redirect()->route('permissions.index');


        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('permissions-role')) {

            Permission::findOrFail($id)->delete();

            return redirect()->back()->with('success', 'Te dhenat u fshin me sukses');

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }


    }
}