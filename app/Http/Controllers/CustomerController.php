<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    public function __construct()
    {
        $this->authorizeResource(Customer::class, 'customer');
    }
    
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

        return  response()->json(['status' => true, 'data' => new CustomerResource($customer)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        if ($customer)   return  response()->json(['status' => true, 'data' => new CustomerResource($customer)], 200);
        else   return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
    }
  
     
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->fill($request->all())->save();

        return  response()->json(['status' => true, 'data' => new CustomerResource($customer)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    { 
        if(!$customer)  return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
      
        return  response()->json(['status' => true, 'data' => Customer::destroy($customer->id)], 200);
    }
}
