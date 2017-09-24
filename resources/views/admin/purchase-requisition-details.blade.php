@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">PURCHASE REQUISITION DETAILS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <div id="submit-status"></div>
            <form id="purchaseReqDetailsForm" action="{{ route('purchase-requisition-details') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Requisition</label>
                            <select name="purchase_req_id" id="purchase_req_id" class="form-control">
                                <option value="">Select Purchase Requisition</option>
                                @foreach($purchase_equisitions as $purchase_equisition)
                                    <option value="{{ $purchase_equisition->id }}">{{ $purchase_equisition->budgetType->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>Asset</label>
                            <select name="asset_id" id="asset_id" class="form-control">
                                <option value="">Select Asset</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">
                                        {{ $asset->name }},
                                        Type - {{ $asset->assetTypes ? $asset->assetTypes->name : '' }},
                                        Dept - {{ $asset->departments ? $asset->departments->name : '' }},
                                        Employee - {{ $asset->employee ? $asset->employee->name : '' }},
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Approximate Price</label>
                            <input type="number" name="approx_price" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" id="savePurchaseReqDetails" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="purchaseReqDetailsEditForm" action="{{ route('update-purchase-requisition-detail') }}" method="post" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Requisition</label>
                            <select name="purchase_req_id" id="purchase_req_id" class="form-control">
                                <option value="">Select Purchase Requisition</option>
                                @foreach($purchase_equisitions as $purchase_equisition)
                                    <option value="{{ $purchase_equisition->id }}">{{ $purchase_equisition->budgetType->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset</label>
                            <select name="asset_id" class="form-control">
                                <option value="">Select Asset Type</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Approximate Price</label>
                            <input type="number" name="approx_price" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="form-group">
                            <button type="button" id="CancelUpdatePurchaseReqDetails" class="btn btn-warning btn-cancel-edit">Cancel</button>
                            <button type="submit" id="updatePurchaseReqDetails" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="purchase-requisition-details"></div>
    </div>
@endsection

@section('script')
    @include('../partials.purchase-requisition-details')
    <script>

        $(document).ready(function () {

            function purchaseRequisitionDetailsData(data) {
                console.log(data);
                var theTemplateScript = $("#purchase-requisition-details-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#purchase-requisition-details').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#purchaseRequisitionDetailsDataTable').DataTable();
            }

            function getPurchaseRequisitionDetails(){
                $.ajax({url: "{{ route('json-purchase-requisition-details') }}", success: function(result){
                    purchaseRequisitionDetailsData(result);
                }});
            }

            $("#purchaseReqDetailsForm" ).submit(function( event ) {
                $('#savePurchaseReqDetails').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#savePurchaseReqDetails').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#purchaseReqDetailsForm" )[0].reset();
                    getPurchaseRequisitionDetails();
                }).error(function (xhr, status, error) {
                    $('#savePurchaseReqDetails').prop('disabled' ,false);
                     var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#purchaseReqDetailsForm").css({"display":"none"});
                $("#purchaseReqDetailsEditForm").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('json-purchase-requisition-detail') }}/"+item;
                var formUrl = "{{ route('update-purchase-requisition-detail') }}/"+item;
                $("#purchaseReqDetailsEditForm").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        console.log(data);
                        $("#purchaseReqDetailsEditForm input[name=approx_price]").val(data.approx_price);
                        $("#purchaseReqDetailsEditForm input[name=quantity]").val(data.quantity);
                        $("#purchaseReqDetailsEditForm select[name=asset_id]").val(data.asset.id);
                        $("#purchaseReqDetailsEditForm select[name=purchase_req_id]").val(data.purchase_requisition.id);
                    }
                });
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#purchaseReqDetailsEditForm").css({"display":"none"});
                $("#purchaseReqDetailsForm").css({"display":"block"});
            });

            $("#purchaseReqDetailsEditForm" ).submit(function( event ) {
                $('#updatePurchaseReqDetails').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $(this).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updatePurchaseReqDetails').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#purchaseReqDetailsEditForm" )[0].reset();
                    $("#purchaseReqDetailsEditForm").css({"display":"none"});
                    $("#purchaseReqDetailsForm").css({"display":"block"});
                    getPurchaseRequisitionDetails();
                }).error(function (xhr, status, error) {
                    $('#updatePurchaseReqDetails').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('delete-purchase-requisition-detail') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getPurchaseRequisitionDetails();
                        assetListOption();
                    }
                });
            });

            function assetListOption() {
                var url = "{{ route('get-asset-list-html') }}";
                $.ajax({
                    url: url,
                    success: function(data){
                        $('select[name="asset_id"]').html(data);
                        console.log(data);
                    }
                });
            }

            assetListOption();

            getPurchaseRequisitionDetails();
        });

    </script>
@endsection