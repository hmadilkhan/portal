<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FinanceOption;
use App\Models\SalesPartner;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("customer.index", [
            "customers" => Customer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("customer.create",[
            "financeoptions" => FinanceOption::all(),
            "partners" => SalesPartner::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'system_size' => 'required',
            'sold_date' => 'required',
            'sales_partner_id' => 'required',
            'notes' => 'required',
            'finance_option_id' => 'required',
            'contract_amount' => 'required',
            'redline_costs' => 'required',
            'adders' => 'required',
            'commission' => 'required',
            'dealer_fee' => 'required',
        ]);
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
