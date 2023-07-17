<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all()->where('role_id', 2));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (User::find($id))   return  response()->json(['status' => true, 'data' => new UserResource(User::find($id))], 200);
        else   return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user=User::find($id);
        $user->password=Hash::make($request->password);
        $user->fill($request->all())->save();

        return  response()->json(['status' => true, 'data' => new UserResource($user)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        
        if(!$user)  return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
      
        return  response()->json(['status' => true, 'data' => User::destroy($id)], 200);
    }
}
