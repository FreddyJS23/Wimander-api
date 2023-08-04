<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection(User::all()->where('role_id', 2));
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
      
        if ($user)   return  response()->json(['status' => true, 'user' => new UserResource($user)], 200);
        else   return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->password = Hash::make($request->password);
        $user->fill($request->all())->save();

        return  response()->json(['status' => true, 'user' => new UserResource($user)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user)  return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
        return  response()->json(['status' => true, 'userID' => User::destroy($user->id) ? $user->id : ''  ], 200);
    }
}
