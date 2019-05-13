<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ];
        //validate the request
       $this->validate($request, $rules);
        //instantiate the User
        $user = new User();
        $user->name    = $request->input('name');
        $user->email  = $request->input('email');
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
        $user = User::findOrFail($userId);
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ];
        //validate the request
       $this->validate($request, $rules);
        //instantiate the User

        //find the user using its id
        $user = User::findOrFail($userId);
        //Check if the request has name
        if ($request->has('name')) {
            $user->name    = $request->input('name');
        }
        //Check if the request has email
        if ($request->has('email')) {
            $user->email  = $request->input('email');
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
        //find the user using its id
        $user = User::findOrFail($userId);
        $user->delete();
        //Return the new user
        return $this->successResponse($user);
    }

}
