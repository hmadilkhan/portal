@extends("layouts.master")
@section('title', 'Create Customer')
@section('content')
<div class="card card-info">
    <div class="card-body">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card border-0 mb-4 no-bg">
                    <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                        <h3 class=" fw-bold flex-fill mb-0 mt-sm-0">Customer</h3>
                        <a href="{{route('customers.index')}}" class="btn btn-dark me-1 mt-1 w-sm-100" id="openemployee"><i class="icofont-arrow-left me-2 fs-6"></i>Back to List</a>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
        <form id="form" method="post" action="{{route('customers.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-sm-6 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                    @error("first_name")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                    @error("last_name")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Street</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Street">
                    @error("street")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City">
                    @error("city")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="State">
                    @error("state")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code">
                    @error("zipcode")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="phone">
                    @error("phone")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    @error("email")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-sm-4">
                    <label for="sold_date" class="form-label">Sold Date</label>
                    <input type="date" class="form-control" id="sold_date" name="sold_date" placeholder="Sold Date">
                    @error("sold_date")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Sales Partner</label>
                    <select class="form-select select2" aria-label="Default select Sales Partner" id="sales_partner_id" name="sales_partner_id">
                        <option value="">Select Sales Partner</option>
                        @foreach ($partners as $partner)
                        <option value="{{ $partner->id }}">
                            {{ $partner->name }}
                        </option>
                        @endforeach
                    </select>
                    @error("sales_partner_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label for="code" class="form-label">Panel Qty</label>
                    <input type="text" class="form-control" id="panel_qty" name="panel_qty" placeholder="System Size" onblur="getRedlineCost()">
                    @error("panel_qty")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Inverter Type</label>
                    <select class="form-select select2" aria-label="Default select Inverter Type" id="inverter_type_id" name="inverter_type_id" onchange="getRedlineCost()">
                        <option value="">Select Inverter Type</option>
                        @foreach ($inverter_types as $inverter)
                        <option value="{{ $inverter->id }}">
                            {{ $inverter->name }}
                        </option>
                        @endforeach
                    </select>
                    @error("inverter_type_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Module Type</label>
                    <select class="form-select select2" aria-label="Default select Module Type" id="module_type_id" name="module_type_id">
                        <option value="">Select Module Type</option>
                        @foreach ($modules as $module)
                        <option value="{{ $module->id }}">
                            {{ $module->name }}
                        </option>
                        @endforeach
                    </select>
                    @error("module_type_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Battery Type</label>
                    <select class="form-select select2" aria-label="Default select Battery Type" id="battery_type_id" name="battery_type_id">
                        <option value="">Select Battery Type</option>
                        @foreach ($battery_types as $battery)
                        <option value="{{ $battery->id }}">
                            {{ $battery->name }}
                        </option>
                        @endforeach
                    </select>
                    @error("battery_type_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Inverter Qty</label>
                    <input type="text" class="form-control" id="inverter_qty" name="inverter_qty" placeholder="Inverter Qty">
                    @error("inverter_qty")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Module Qty</label>
                    <input type="text" class="form-control" id="module_qty" name="module_qty" placeholder="Module Qty">
                    @error("module_qty")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="exampleFormControlInput877" class="form-label">Battery Qty</label>
                    <input type="text" class="form-control" id="battery_qty" name="battery_qty" placeholder="Battery Qty">
                    @error("battery_qty")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card border-0 mb-4 no-bg">
                        <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                            <h6 class=" fw-bold flex-fill mb-0 mt-sm-0">Adders Area</h6>
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card border-0 mb-4 no-bg">
                        <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                            <h6 class=" fw-bold flex-fill mb-0 mt-sm-0">Customer Financing</h6>
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
            <div class="row g-3 mb-3">
                <div class="col-sm-3 mb-3">
                    <label for="finance_option_id" class="form-label">Finance Option</label>
                    <select class="form-select select2" aria-label="Default select Finance Option" id="finance_option_id" name="finance_option_id">
                        <option value="">Select Finance Option</option>
                        @foreach ($financeoptions as $financeOption)
                        <option value="{{ $financeOption->id }}">
                            {{ $financeOption->name }}
                        </option>
                        @endforeach
                    </select>
                    @error("finance_option_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3 loandiv">
                    <label for="loan_term_id" class="form-label">Loan Term</label>
                    <select class="form-select select2" aria-label="Default select Loan Term" id="loan_term_id" name="loan_term_id">
                        <option value="">Select Loan Term</option>
                    </select>
                    @error("loan_term_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3 loandiv">
                    <label for="loan_apr_id" class="form-label">Loan Apr</label>
                    <select class="form-select select2" aria-label="Default select Loan Apr" id="loan_apr_id" name="loan_apr_id">
                        <option value="">Select Loan Apr</option>
                    </select>
                    @error("loan_apr_id")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="contract_amount" class="form-label">Contract Amount</label>
                    <input type="text" class="form-control" id="contract_amount" name="contract_amount" placeholder="Contract Amount" onblur="dealerFee()">
                    @error("contract_amount")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="redline_costs" class="form-label">Redline Costs</label>
                    <input type="text" class="form-control" id="redline_costs" name="redline_costs" placeholder="Redline Costs">
                    @error("redline_costs")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="adders" class="form-label">Adders</label>
                    <input type="text" class="form-control" id="adders" name="adders" placeholder="Adders" value="0">
                    @error("adders")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="commission" class="form-label">Commission</label>
                    <input type="text" class="form-control" id="commission" name="commission" placeholder="Commission" value="0">
                    @error("commission")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="dealer_fee" class="form-label">Dealer Fee</label>
                    <input readonly type="text" class="form-control" id="dealer_fee" name="dealer_fee" placeholder="Dealer Fee">
                    @error("dealer_fee")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="dealer_fee_amount" class="form-label">Dealer Fee Amount</label>
                    <input type="text" class="form-control" id="dealer_fee_amount" name="dealer_fee_amount" placeholder="Dealer Fee Amount" value="0">
                    @error("dealer_fee_amount")
                    <div class="text-danger message mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="icofont-save me-2 fs-6"></i>Create</button>
        </form>

    </div>
</div>
@endsection
@section("scripts")
<script>
    $(document).ready(function() {
        $(".loandiv").css("display", "none");
    });
    $("#finance_option_id").change(function() {
        if ($(this).val() != 1) {
            $(".loandiv").css("display", "block");
            $.ajax({
                method: "POST",
                url: "{{ route('get.loan.terms') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val(),
                },
                dataType: 'json',
                success: function(response) {
                    $('#loan_term_id').empty();
                    $('#loan_term_id').append($('<option value="">Select Loan Term</soption>'));
                    $.each(response.terms, function(i, term) {
                        $('#loan_term_id').append($('<option  value="' + term.id + '">' + term.year + '</option>'));
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            })
        } else {
            $(".loandiv").css("display", "none");
            $("#dealer_fee").val(0);
            $("#dealer_fee_amount").val(0);
        }
    });
    $("#loan_term_id").change(function() {
        if ($(this).val() != "") {
            $.ajax({
                method: "POST",
                url: "{{ route('get.loan.aprs') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $(this).val(),
                },
                dataType: 'json',
                success: function(response) {
                    $('#loan_apr_id').empty();
                    $('#loan_apr_id').append($('<option value="">Select Loan Apr</soption>'));
                    $.each(response.aprs, function(i, apr) {
                        $('#loan_apr_id').append($('<option  value="' + apr.id + '">' + (apr.apr * 100).toFixed(2) + '%</option>'));
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            })
        }
    });
    $("#loan_apr_id").change(function() {
        if ($(this).val() != "") {
            getDealerFee($(this).val())
        }
    });

    function getDealerFee(value) {
        $.ajax({
            method: "POST",
            url: "{{ route('get.dealer.fee') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id: value,
            },
            dataType: 'json',
            success: function(response) {
                // let dealerFee = response.dealerfee;
                // let dealerPercentage = (response.dealerfee * 100).toFixed(2);
                // $('#dealer_fee').val('');
                // $('#dealer_fee').val(dealerPercentage);
                dealerFee(response.dealerfee);
                calculateCommission()

            },
            error: function(error) {
                console.log(error.responseJSON.message);
            }
        })
    }

    function getRedlineCost() {
        let panelQty = $("#panel_qty").val();
        let inverterType = $("#inverter_type_id").val();

        if (panelQty != "" && inverterType != "") {
            $.ajax({
                method: "POST",
                url: "{{ route('get.redline.cost') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    qty: panelQty,
                    inverterType: inverterType,
                },
                dataType: 'json',
                success: function(response) {
                    $('#redline_costs').val('');
                    $('#redline_costs').val(response.redlinecost);

                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            })
        }
        calculateCommission()
    }

    function dealerFee(value) {
        let dealerFee = (value != undefined ? value : parseFloat($("#dealer_fee").val()));
        let dealerPercentage = (dealerFee * 100).toFixed(2);
        let contractAmount = parseFloat($('#contract_amount').val());
        if (value != undefined) {
            $('#dealer_fee').val('');
            $('#dealer_fee').val(dealerPercentage);
        }
        if(contractAmount != "" && value != undefined ){
            $('#dealer_fee_amount').val(value*contractAmount);
        }else{
            $('#dealer_fee_amount').val((dealerFee / 100)*contractAmount);
        }
        calculateCommission()
    }

    function calculateCommission() {
        let contractAmount = parseFloat($("#contract_amount").val());
        let dealerFeeAmount = parseFloat($("#dealer_fee_amount").val());
        let redlineFee = parseFloat($("#redline_costs").val());
        let adders = parseFloat($("#adders").val());
        let commission = contractAmount - dealerFeeAmount - redlineFee - adders;
        $("#commission").val(commission);
    }
</script>
@endsection