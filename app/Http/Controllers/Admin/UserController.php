<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\ValidationException;
use App\Role;
class UserController extends Controller
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

    {  if(Auth::user()->can('read-users')) {

        $users = User::orderBy('id','asc')->get();
        return view('backend.pages.users')->withUsers($users);
    }else{

        return redirect()->back()->with('success','Nuk keni qasje');
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        if(Auth::user()->can('create-users')) {
        return view('backend.pages.create_users');

    }else{

        return redirect()->back()->with('success','Nuk keni qasje');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(UserRequest $request)
//    {
//
//
//           return response()->json([
//               'success' => true,
//               'message' => 'Super'
//           ], 200);
//
//
//
//    }

    public function store(Request $request)
    {
        if(Auth::user()->can('create-users')) {
        $user = new User;

        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'

            ]);
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors(), 422);
        }

        // Add data
        $user->name = Input::get('name');
        $user->email =  Input::get('email');
        $user->password =  Hash::make(Input::get('password'));
        $user->save();
        return response()->json($user, 201);


        }else{

            return redirect()->back()->with('success','Nuk keni qasje');
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
        $user = User::where('id', $id)->with('roles')->first();
        return view('backend.pages.show_user')->withUser($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('update-users')) {

            $roles = Role::all();
            $user = User::where('id',$id)->with('roles')->first();
            return view('backend.pages.edit_users')->withUser($user)->withRoles($roles);
        }

   else{

return redirect()->back()->with('success','Nuk keni qasje');
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

        if(Auth::user()->can('update-users')) {


            if (Auth::user()->can('edit-user')) {
                try {
                    $this->validate($request, [

                        'name' => 'required|max:25',
                        'email' => 'required|email|unique:users,email,' . $id,

                    ]);
                } catch (ValidationException $e) {
                    return response()->json($e->validator->errors(), 422);
                }


                if (Input::get('check') == 'yes') {
                    try {
                        $this->validate($request, [
                            'password' => 'required|min:6|confirmed',
                            'password_confirmation' => 'required|min:6'
                        ]);
                    } catch (ValidationException $e) {
                        return response()->json($e->validator->errors(), 422);
                    }


                    $user = User::findOrFail($id);

                    $user->name = Input::get('name');
                    $user->email = Input::get('email');
                    $user->password = Hash::make(Input::get('password'));
                    $user->save();


                    if (Input::get('roles')) {
                        $roles = Input::get('roles', []);
                        $user->syncRoles($roles);

                        return response()->json($user, 201);

                    } else {

                        return response()->json($user, 201);
                    }


                } else {


                    $user = User::findOrFail($id);
                    $user->name = Input::get('name');
                    $user->email = Input::get('email');
                    $user->save();

                    if (Input::get('roles')) {
                        $roles = Input::get('roles', []);
                        $user->syncRoles($roles);

                        return response()->json($user, 201);

                    } else {

                        return response()->json($user, 201);
                    }


                }


            } else {

                return response()->json('mes', 201);
            }

        }
        else{

            return redirect()->back()->with('success','Nuk keni qasje');
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
        if (Auth::user()->can('delete-users')) {

            $user = User::find($id)->delete();

            if ($user) {
                return redirect()->back()->with('success', 'Perdoruesi u fshi me sukses');
            } else {

                return redirect()->back()->with('success', 'Gabim gjat fshirjes');
            }

        }
        else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

}
