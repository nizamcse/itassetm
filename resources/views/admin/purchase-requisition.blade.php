@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">PURCHASE REQUISITION</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <div id="submit-status"></div>
            <form id="purchaseReqForm" action="{{ route('purchase-requisition') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Type</label>
                            <select name="budget_type" id="budget_type" class="form-control">
                                <option value="">select Budget Type</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">{{ $budget_type->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Particulars</label>
                            <input type="text" name="particulars" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" id="savePurchaseReq" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="purchaseReqEditForm" action="{{ route('budget-type') }}" method="post" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Type</label>
                            <select name="budget_type" id="budget_type" class="form-control">
                                <option value="">select Budget Type</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">{{ $budget_type->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Particulars</label>
                            <input type="text" name="particulars" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="form-group">
                            <button type="button" id="CancelUpdatePurchaseReq" class="btn btn-warning btn-cancel-edit">Cancel</button>
                            <button type="submit" id="updatePurchaseReq" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="purchase-requisitions"></div>
    </div>
@endsection

@section('script')
    @include('../partials.purchase-requisition')
    <script>

        $(document).ready(function () {

            function purchaseRequisitionData(data) {
                var theTemplateScript = $("#purchase-requisition-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#purchase-requisitions').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#purchaseRequisitionDataTable').DataTable();
            }

            function getPurchaseRequisitions(){
                $.ajax({url: "{{ route('purchase-requisitions') }}", success: function(result){
                    purchaseRequisitionData(result);
                }});
            }

            $("#purchaseReqForm" ).submit(function( event ) {
                $('#savePurchaseReq').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#savePurchaseReq').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#purchaseReqForm" )[0].reset();
                    getPurchaseRequisitions();
                }).error(function (xhr, status, error) {
                    $('#savePurchaseReq').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#purchaseReqForm").css({"display":"none"});
                $("#purchaseReqEditForm").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('single-purchase-requisition') }}/"+item;
                var formUrl = "{{ route('update-purchase-requisition') }}/"+item;
                $("#purchaseReqEditForm").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        $("#purchaseReqEditForm input[name=particulars]").val(data.particulars);
                        $("#purchaseReqEditForm select[name=budget_type]").val(data.budget_type.id);
                    }
                });
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#purchaseReqEditForm").css({"display":"none"});
                $("#purchaseReqForm").css({"display":"block"});
            });

            $("#purchaseReqEditForm" ).submit(function( event ) {
                $('#updatePurchaseReq').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $(this).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updatePurchaseReq').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#purchaseReqEditForm" )[0].reset();
                    $("#purchaseReqEditForm").css({"display":"none"});
                    $("#purchaseReqForm").css({"display":"block"});
                    getPurchaseRequisitions();
                }).error(function (xhr, status, error) {
                    $('#updatePurchaseReq').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('delete-purchase-requisitions') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getPurchaseRequisitions();
                    }
                });
            });

            getPurchaseRequisitions();
        });

    </script>
@endsection