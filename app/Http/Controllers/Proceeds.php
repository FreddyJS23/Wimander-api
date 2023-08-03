<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use Illuminate\Support\Facades\Auth;

class Proceeds extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return response()->json(['proceeds'=> Connection::select('amount')->where('user_id', Auth::id())->sum('amount')],200);
    }
}
