<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerFinance;
use App\Models\FinanceOption;
use App\Models\SalesPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("customer.index", [
            "customers" => Customer::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("customer.create", [
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
            DB::beginTransaction();
            $customer = Customer::create($request->except(["finance_option_id", "contract_amount", "redline_costs", "adders", "commission", "dealer_fee"]));
            CustomerFinance::create([
                "customer_id" => $customer->id,
                "finance_option_id" => $request->finance_option_id,
                "contract_amount" => $request->contract_amount,
                "redline_costs" => $request->redline_costs,
                "adders" => $request->adders,
                "commission" => $request->commission,
                "adders" => $request->adders,
                "dealer_fee" => $request->dealer_fee,
            ]);
            DB::commit();
            return redirect()->route("customers.index");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
            return redirect()->route("customers.create");
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
        return view("customer.edit", [
            "customer" => $customer,
            "financeoptions" => FinanceOption::all(),
            "partners" => SalesPartner::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            DB::beginTransaction();
            $customer->update($request->except(["finance_option_id", "contract_amount", "redline_costs", "adders", "commission", "dealer_fee"]));
            $customer->finances()->update($request->only(["finance_option_id", "contract_amount", "redline_costs", "adders", "commission", "dealer_fee"]));
            DB::commit();
            return redirect()->route("customers.index");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
