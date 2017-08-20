@extends('layouts.admin')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Asset Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="budgetTypeForm" action="{{ route('budget-type') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Type Name</label>
                            <input type="text" class="form-control" name="budget_type_name" value="" placeholder="Budget Type Name" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Year</label>
                            <select name="budget_type_year" id="budget_type_year" class="form-control">
                                <option value="">Select Year</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type Info</label>
                            <select name="type_info" id="type_info" class="form-control">
                                <option value="">Select Type</option>
                                <option value="budget">Budget</option>
                                <option value="purchase_requisition">Purchase Requisition</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Level Of Approved</label>
                            <input type="text" name="budget_type_level_apv" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" id="saveBudgetType" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="budgetTypeEditForm" action="{{ route('budget-type') }}" method="post" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Type Name</label>
                            <input type="text" class="form-control" name="budget_type_name" value="" placeholder="Budget Type Name" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Budget Type Year</label>
                            <select name="budget_type_year" id="budget_type_year" class="form-control">
                                <option value="">Select Year</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type Info</label>
                            <select name="type_info" id="type_info" class="form-control">
                                <option value="">Select Type</option>
                                <option value="budget">Budget</option>
                                <option value="purchase_requisition">Purchase Requisition</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Level Of Approved</label>
                            <input type="text" name="budget_type_level_apv" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="form-group">
                            <button type="button" id="cancelBudgetTypeEdit" class="btn btn-warning btn-cancel-edit">Cancel</button>
                            <button type="submit" id="updateBudgetType" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="budgetTypes"></div>
    </div>
@endsection

@section('script')
    @include('../partials.budget-types')
    <script>

        $(document).ready(function () {

            function budgetTypeData(data) {

                Handlebars.registerHelper('ifEquals', function(a, b, options) {
                    if (a === b) {
                        return options.fn(this);
                    }

                    return options.inverse(this);
                });

                var theTemplateScript = $("#budget-type-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#budgetTypes').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#budgetTypetData').DataTable();
            }

            function getBudgetTypes(){
                $.ajax({url: "{{ route('json-budget-types') }}", success: function(result){
                    budgetTypeData(result);
                }});
            }

            $("#budgetTypeForm" ).submit(function( event ) {
                $('#saveBudgetType').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#saveBudgetType').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#budgetTypeForm" )[0].reset();
                    getBudgetTypes();
                }).error(function (xhr, status, error) {
                    $('#saveBudgetType').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#budgetTypeForm").css({"display":"none"});
                $("#budgetTypeEditForm").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('json-get-budget-type') }}/"+item;
                var formUrl = "{{ route('budget-type-update-json') }}/"+item;
                $("#budgetTypeEditForm").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        $("#budgetTypeEditForm input[name=budget_type_name]").val(data.budget_type.budget_type_name);
                        $("#budgetTypeEditForm select[name=budget_type_year]").val(data.budget_type.budget_type_year);
                        $("#budgetTypeEditForm select[name=type_info]").val(data.budget_type.type_info);
                        $("#budgetTypeEditForm input[name=budget_type_level_apv]").val(data.budget_type.budget_type_level_apv);
                    }
                });
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#budgetTypeEditForm").css({"display":"none"});
                $("#budgetTypeForm").css({"display":"block"});
            });

            $("#budgetTypeEditForm" ).submit(function( event ) {
                $('#updateBudgetType').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $(this).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updateBudgetType').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#budgetTypeEditForm" )[0].reset();
                    $("#budgetTypeEditForm").css({"display":"none"});
                    $("#budgetTypeForm").css({"display":"block"});
                    getBudgetTypes();
                }).error(function (xhr, status, error) {
                    $('#saveBudgetType').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('json-delete-budget-type') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getBudgetTypes();
                    }
                });
            });

            getBudgetTypes();
        });

    </script>
@endsection