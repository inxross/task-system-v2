<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUserForm;
use App\Http\Requests\UpdateUserForm;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return response()->json([
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserForm $request)
    {
        $user = User::create([
            'name' => $request->get('user_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'api_token' => Str::random(60),
        ]);

        return response()->json([
            'user' => $user,
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserForm $request, User $user)
    {
        //$id = $request->get('id');
        //$user = User::find($id);

        $user->name = $request->get('user_name');
        $user->email = $request->get('email');

        $user->save();
    }

    public function passwordUpdate(Request $request)
    {
        $id = request('id');
        $user = User::find($id);

        $user->password = Hash::make(request('createUserData.password'));

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request('id');
        $category = User::find($id);

        $category->delete();
    }
}
