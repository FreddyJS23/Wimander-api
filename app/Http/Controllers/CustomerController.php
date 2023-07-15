<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all()->where('user_id', Auth::id()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $user_id = Auth::id();

        $customer = Customer::create($request->except('start_date', 'expiration_date', 'amount', 'user_id') + ['user_id' => $user_id]);

        $customer->connection()->create($request->except('name', 'last_name', 'mac', 'locked', 'user_id') + ['user_id' => $user_id]);

        return  response()->json(['status' => true, 'data' => new CustomerResource($customer)], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Customer::find($id))   return  response()->json(['status' => true, 'data' => new CustomerResource(Customer::find($id))], 200);
        else   return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
    }
  
     
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $customer=Customer::find($id);
        
        $customer->fill($request->all())->save();

        return  response()->json(['status' => true, 'data' => new CustomerResource($customer)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer=Customer::find($id);
        
        if(!$customer)  return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
      
        return  response()->json(['status' => true, 'data' => Customer::destroy($id)], 200);
    }
}
