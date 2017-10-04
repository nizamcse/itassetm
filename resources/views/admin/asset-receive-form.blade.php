@extends('layouts.admin')

@section('content')
    <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h2 class="box-title text-center" style="display: block; font-size: 24px; margin:15px 0">Asset Receive Information Form</h2>
            <p class="text-center">Asset Name: {{ $pur_req_detail->asset->name }}, Requisition No: {{ $pur_req_detail->purchase_req_id }}</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <form action="{{ route('post-purchase-receive-details',['per_req_id' => $pur_req_id, 'asset_id' => $asset_id]) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Budget Type</label>
                            <select name="budget" id="budget" class="form-control" required>
                                <option value="">Select Budget Type</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">{{ $budget_type->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Budget Head</label>
                            <select name="budget_head" id="budget-head" class="form-control" required>
                                <option value="">Select Budget Head</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Receive Date</label>
                            <input name="receive_date" class="datepicker form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Product Quantity <span class="err-text err-qty"></span></label>
                            <input type="number" name="quantity" class="form-control" max="{{ $vw_receive_detail ? $vw_receive_detail->REQ_QTY - $vw_receive_detail->Receive_QTY : $pur_req_detail->quantity }}" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Product Price<span class="err-text err-amount"></span></label>
                            <input type="text" name="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Vendor</label>
                            <select name="vendor_id" id="vendor_id" class="form-control" required>
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Purchase Order No</label>
                            <input type="text" name="purchase_order_no" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Purchase Order Date</label>
                            <input name="purchase_order_date" class="datepicker form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Vendor Invoice No</label>
                            <input type="text" name="vendor_invoice_no" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Vendor Delivery Date</label>
                            <input name="vendor_delivery_date" class="datepicker form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Warranty Start From</label>
                            <input name="warranty_start_from" class="datepicker form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Warranty Duration (In Month)</label>
                            <input type="number" name="warranty_duration" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Product SL No</label>
                            <input type="text" name="product_sl_no" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Product Licence No</label>
                            <input type="text" name="product_licence_no" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for=""></label>
                            <button id="receive-btn" class="btn btn-flat btn-info" type="submit" style="
    margin-top: 25px;
">RECEIVE</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#budget").change(function () {
                getBudgetHead($(this).val());
            });

            $("#budget-head").change(function () {
                getRemBalance();
            });

            function getRemBalance() {
                var bgt = $("select#budget").val();
                var bhd = $("select#budget-head").val();

                if(bgt && bhd){
                    var url = "{{ route('get-rem-balance') }}/"+bgt+"/"+bhd;
                    $.ajax({url: url, success: function(result){
                        $("input[name=price]").attr({
                            "max" : result.remaining_amount.Remaining_Balance
                        });
                        checkPriceValidity();
                    }});
                }

            }

            function checkPriceValidity() {
                var price = $("input[name=price]").val();
                var rem   = $("input[name=price]").attr('max');
                if(rem - price < 0){
                    var txt = "Max remaining amount BDT "+rem;
                    $("span.err-amount").text(txt);
                    $("button#receive-btn").prop("disabled",true);
                }
                else{
                    $("span.err-amount").text("");
                    $("button#receive-btn").prop("disabled",false);
                }
            }

            $('input[name=price]').keyup(function () {
                checkPriceValidity();
            });

            function getBudgetHead(id){
                var url = "{{ route('get-budget-head') }}/"+id;
                $.ajax({url: url, success: function(result){
                    setBudgetHeadOption(result);
                }});
            }
            function setBudgetHeadOption(option) {
                $("#budget-head").html(option);
            }

            $('input[name=quantity]').keyup(function () {
                var max = $(this).attr('max');
                var qty = $(this).val();
                var txt = "Max quantity is "+max;
                if(max<qty){
                    $(this).parent().addClass('error');
                    $("span.err-qty").text(txt);
                    $("button#receive-btn").prop("disabled",true);
                }
                else{
                    $("span.err-qty").text("");
                    $("button#receive-btn").prop("disabled",false);
                }
            });

            var max = $('input[name=quantity]').attr('max');
            var qty = $('input[name=quantity]').val();
            var txt = "Max quantity is "+max;
            if(max<qty){
                $(this).parent().addClass('error');
                $("span.err-qty").text(txt);
                $("button#receive-btn").prop("disabled",true);
            }
            else{
                $("span.err-qty").text("");
                $("button#receive-btn").prop("disabled",false);
            }

            $(".datepicker").datepicker();

            getRemBalance();

        });
    </script>
@endsection