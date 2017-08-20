<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use DB;
use App\Http\Requests\UserRequest;
use Response;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $users = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->selectRaw('users.*, roles.display_name as role_name, roles.name as user_role')->get();
        return view('users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //$admin = Auth::user();

        $input = $request->all();
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->save($request->all());

        $role_id = $input['role'];

        DB::table('role_user')->insert(
            ['user_id' => $user->id, 'role_id' => $role_id]
        );

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->selectRaw('roles.name as user_role')
            ->where('users.id', $id)->first();
        $user = User::findOrFail($id);
        $roles = Role::lists('display_name', 'id')->all();

        if($role->user_role == 'owner'):
            $users = DB::table('users')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->selectRaw('users.*, roles.display_name as role_name, roles.name as user_role')->get();
            return view('users.users', compact('users'));
        else:
            return view('users.edit', compact('user', 'roles'));
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $input = $request->all();

        $role_id = $input['role'];

        $user_password = bcrypt($input['password']);

        DB::table('role_user')
            ->where('user_id', $id)
            ->update(['role_id' => $role_id]);

        DB::table('users')
            ->where('id', $id)
            ->update(['password' => $user_password]);

        return redirect('users');
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

    /*
    public function passwordChange()
    {
        return view('users.password-reset');
    }

    public function passwordUpdate(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();

        $currentPass = bcrypt($input['current_password']);
        $newPass = $input['new_password'];
        $newPassConf = $input['password_confirmation'];

        if($user->password == $currentPass && $newPass == $newPassConf) {

            $newPassword = bcrypt($input['new_password']);

            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => $newPassword]);
            $success = "success";
            return view('users.password-reset', compact('success'));
        }else{
            $fail = "fail";
            return view('users.password-reset', compact('fail'));
        }

        return view('users.password-reset');

    }

*/

}
