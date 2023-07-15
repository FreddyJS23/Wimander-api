<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectionRequest;
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
    public function __invoke(ConnectionRequest $request, $id)
    {
        $customerConnection = Customer::find($id)->connection;

        $fechaVencimiento = new DateTime($customerConnection->expiration_date);

        if ($request->extendsDate == "15D") {

            $customerConnection->connection->expiration_date = $fechaVencimiento->add(new DateInterval('P15D'))->format('Y-m-d');
            $customerConnection->save();
       
        } elseif ($request->extendsDate == "30D") {

            $customerConnection->expiration_date = $fechaVencimiento->add(new DateInterval('P30D'))->format('Y-m-d');
            $customerConnection->save();
        }

        return  response()->json(['status' => true], 200);
    }
}
