<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query all users
        $users = User::all();

        return view("allUsers", ["users"=>  $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
    //    validated input
        $validated = $request->validated();
        
        User::create([
            'first_name' => $validated['first_name'],
            'surname'=> $validated['surname'],
            'middle_name' => $validated["middle_name"],
            'phone'=> $validated["phone"],
            'email' => $validated['email'],
            "role" => $validated["role"],
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'User registered successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("editUser", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {
        User::where('id', $user->id)->update([
            'first_name' => $request->first_name,
            'surname'=> $request->surname,
            'middle_name' => $request->middle_name,
            'phone'=> $request->phone,
            'email' => $request->email,
            "role" => $request,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success', 'User updated succesfully');
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


    /**
     * Deactivate the user 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        //
    }
    
    /**
     * Show the profile of a single user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show (){


    }
}
