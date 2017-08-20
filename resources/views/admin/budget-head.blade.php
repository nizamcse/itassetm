@extends('layouts.admin')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Asset Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="budgetHeadForm" action="#" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Head Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Budget Head Name" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Head Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Level Of Approved</label>
                            <input type="text" name="bhead_level" class="form-control">
                        </div>
                    </div>
                    -->
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="saveBudgetHead">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="budgetHeadEditForm" action="#" method="post" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Head Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Budget Head Name" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Head Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Level Of Approved</label>
                            <input type="text" name="bhead_level" class="form-control">
                        </div>
                    </div>
                    -->
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="button" class="btn btn-warning btn-cancel-edit">Cancel</button>
                            <button type="submit" class="btn btn-success" id="updateBudgetHead">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="budgetHeades"></div>
    </div>
@endsection

@section('script')
    @include('../partials.budget-head-list')
    <script>

        $(document).ready(function () {
            var $parentOptions;
            
            function setOptions() {
                $parentOptions = '<option value="">Select Parent</option>';
                $.ajax({url: "{{ route('json-budget-heads-tree') }}", success: function(result){
                    $parentOptions += result;
                    appendOption();
                }});

            }

            function appendOption() {
                $('select[name="parent_id"]').html($parentOptions);
            }

            function budgetHeadData(data) {
                var theTemplateScript = $("#budget-head-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#budgetHeades').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#budgetHeadListData').DataTable();
            }

            function getBudgetHeades(){
                $.ajax({url: "{{ route('json-budget-heads') }}", success: function(result){
                    budgetHeadData(result);
                }});
            }

            $("#budgetHeadForm" ).submit(function( event ) {
                $('#saveBudgetHead').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    console.log(data);
                    $('#saveBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#budgetHeadForm" )[0].reset();
                    getBudgetHeades();
                    setOptions();
                }).error(function (xhr, status, error) {
                    $('#saveBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#budgetHeadForm").css({"display":"none"});
                $("#budgetHeadEditForm").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('json-get-budget-head') }}/"+item;
                var formUrl = "{{ route('budget-head-update-json') }}/"+item;
                $("#budgetHeadEditForm").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        $("#budgetHeadEditForm input[name=name]").val(data.budget_head.name);
                        $("#budgetHeadEditForm select[name=parent_id]").val(data.budget_head.parent_id);
                        //$("#budgetHeadEditForm input[name=bhead_level]").val(data.budget_head.bhead_level);
                    }
                });
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#budgetHeadEditForm").css({"display":"none"});
                $("#budgetHeadForm").css({"display":"block"});
            });

            $("#budgetHeadEditForm" ).submit(function( event ) {
                $('#updateBudgetHead').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $(this).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updateBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#budgetHeadEditForm" )[0].reset();
                    $("#budgetHeadEditForm").css({"display":"none"});
                    $("#budgetHeadForm").css({"display":"block"});
                    getBudgetHeades();
                    setOptions();
                }).error(function (xhr, status, error) {
                    $('#updateBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('json-delete-budget-head') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getBudgetHeades();
                        setOptions();
                    }
                });
            });

            getBudgetHeades();
            setOptions();

        });

    </script>
@endsection