<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectionRequest;
use App\Models\Connection;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateInterval;
use DateTime;

class ConnectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ConnectionRequest $request,Connection $customerID )
    {
        $fechaVencimiento = new DateTime($customerID->expiration_date);

        if ($request->extendsDate == "15D") {

            $customerID->expiration_date = $fechaVencimiento->add(new DateInterval('P15D'))->format('Y-m-d');
            $customerID->save();
       
        } elseif ($request->extendsDate == "30D") {

            $customerID->expiration_date = $fechaVencimiento->add(new DateInterval('P30D'))->format('Y-m-d');
            $customerID->save();
        }

        return  response()->json(['status' => true], 200);
    }
}
