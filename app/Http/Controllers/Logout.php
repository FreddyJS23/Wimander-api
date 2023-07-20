<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logout extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       $request->user()->currentAccessToken()->delete();
       return response()->json(['status'=>true],200);
    }
}
