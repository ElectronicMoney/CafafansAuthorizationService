<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ApiResponser;


class UserController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Check if the Autthenticated userId is the same as userId
        if (Auth::user()->role->name !== 'Administrator') {
            return $this->errorResponse('Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }
        $users = User::all();
        return $this->successResponse($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //The rules
        $rules = [
            'name'     => 'required|max:255',
            'username' => 'required|max:255',
            'email'    => 'required|max:255',
            'password' => 'required|max:255',
        ];
        //validate the request
       $this->validate($request, $rules);
        //instantiate the User
        $user = new User();
        $user->name     = $request->input('name');
        $user->username = $request->input('username');
        $user->email    = $request->input('email');
          $user->password     = $request->input('password');
        //Save the user
        $user->save();
        //Return the new user
        return $this->successResponse($user, Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($userId) {
        //get user with the given userId
        $user = User::findOrFail($userId);
        //Check if the Autthenticated userId is the same as userId
        if (Auth::user()->id !== $user->id) {
            return $this->errorResponse('Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }
        return $this->successResponse($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId) {
        //The rules
        $rules = [
            'name'     => 'max:255',
            'username' => 'max:255',
            'email'    => 'max:255',
            'password' => 'max:255',
        ];
        //validate the request
       $this->validate($request, $rules);

        //get user with the given userId
        $user = User::findOrFail($userId);
        //Check if the Autthenticated userId is the same as userId
        if (Auth::user()->id !== $user->id) {
            return $this->errorResponse('Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }

        //Check if the request has name
        if ($request->has('name')) {
            $user->name    = $request->input('name');
        }
        //Check if the request has username
        if ($request->has('username')) {
            $user->username    = $request->input('username');
        }
        //Check if the request has email
        if ($request->has('email')) {
            $user->email  = $request->input('email');
        }

        //Check if the request has password
        if ($request->has('password')) {
            $user->password  = $request->input('password');
        }

        //Check if anything changed in user
        if ($user->isClean()) {
            return $this->errorResponse('You must specify a new value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //Save the user
        $user->save();
        //Return the new user
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId) {
        //get user with the given userId
        $user = User::findOrFail($userId);
        //Check if the Autthenticated userId is the same as userId
        if (Auth::user()->id !== $user->id) {
            return $this->errorResponse('Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }

        $user->delete();
        //Return the new user
        return $this->successResponse($user);
    }

}
