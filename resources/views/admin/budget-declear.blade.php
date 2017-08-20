@extends('layouts.admin')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Declear Budget</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="budgetDeclear" action="{{ route('budget-declear') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Type</label>
                            <select name="budget_type" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Budget Types</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">{{ $budget_type->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Head</label>
                            <select name="budget_head" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Budget Head</option>
                                {!! $budget_heads !!}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Particular</label>
                            <input type="text" name="budget_particulars" class="form-control" placeholder="Budget Particular">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Manufacturer</label>
                            <select name="manufacturer_id" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Budget Manufacturer</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">USD Ammount</label>
                            <input type="text" name="usd_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">BDT Ammount</label>
                            <input type="text" name="bdt_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">USD Conversion</label>
                            <input type="text" name="usd_conversion" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Unit Of Measurement</label>
                            <select name="unit" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Measurement Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="budgetDeclearEdit" action="{{ route('budget-declear') }}" method="post" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Type</label>
                            <select name="budget_type" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Budget Types</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">{{ $budget_type->budget_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Head</label>
                            <select name="budget_head" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Budget Head</option>
                                {!! $budget_heads !!}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Particular</label>
                            <input type="text" name="budget_particulars" class="form-control" placeholder="Budget Particular">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Budget Manufacturer</label>
                            <select name="manufacturer_id" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Budget Manufacturer</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">USD Ammount</label>
                            <input type="text" name="usd_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">BDT Ammount</label>
                            <input type="text" name="bdt_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">USD Conversion</label>
                            <input type="text" name="usd_conversion" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Unit Of Measurement</label>
                            <select name="unit" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Measurement Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-cancel-edit">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="budgetDeclearsList"></div>
    </div>
@endsection

@section('script')
    @include('../partials.budget-declear-list')
    <script>

        $(document).ready(function () {

            function showBudgetDeclearData(data){
                var theTemplateScript = $("#budget-declear-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#budgetDeclearsList').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#budgetDeclearListData').DataTable();
            }

            var getBudgetDeclearData = function(){
                var url = "{{ route('json-budget-declears') }}";

                $.ajax({url: url, success: function(result){
                    showBudgetDeclearData(result);
                }});
            };

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('delete-budget-declear') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getBudgetDeclearData();
                    }
                });
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#budgetDeclear").css({"display":"none"});
                $("#budgetDeclearEdit").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('json-budget-declear') }}/"+item;
                var formUrl = "{{ route('update-budget-declear') }}/"+item;
                $("#budgetDeclearEdit").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        console.log(data.yearly_budget);
                        $("#budgetDeclearEdit input[name='budget_particulars']").val(data.yearly_budget.budget_particulars);
                        $("#budgetDeclearEdit input[name='usd_amount']").val(data.yearly_budget.usd_amount);
                        $("#budgetDeclearEdit input[name='bdt_amount']").val(data.yearly_budget.bdt_amount);
                        $("#budgetDeclearEdit input[name='usd_conversion']").val(data.yearly_budget.usd_conversion);
                        $("#budgetDeclearEdit input[name='quantity']").val(data.yearly_budget.quantity);

                        $("#budgetDeclearEdit select[name='unit']").val(data.yearly_budget.unit);
                        $("#budgetDeclearEdit select[name='budget_type']").val(data.yearly_budget.budget_type);
                        $("#budgetDeclearEdit select[name='budget_head']").val(data.yearly_budget.budget_head);
                        $("#budgetDeclearEdit select[name='manufacturer_id']").val(data.yearly_budget.manufacturer_id);
                        $("#budgetDeclearEdit select[name='supplier_id']").val(data.yearly_budget.supplier_id);
                    }
                });
            });

            $("#budgetDeclear").submit(function( event ) {
                var formData = $( this ).serialize();

                var url = $(this).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    //$('#updateBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#budgetDeclear" )[0].reset();
                    getBudgetDeclearData();
                }).error(function (xhr, status, error) {
                    //$('#updateBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $("#budgetDeclearEdit" ).submit(function( event ) {
                //$('#updateBudgetHead').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $(this).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    //$('#updateBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#budgetDeclearEdit" )[0].reset();
                    $("#budgetDeclearEdit").css({"display":"none"});
                    $("#budgetDeclear").css({"display":"block"});
                    getBudgetDeclearData();
                }).error(function (xhr, status, error) {
                    //$('#updateBudgetHead').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#budgetDeclearEdit").css({"display":"none"});
                $("#budgetDeclear").css({"display":"block"});
            });

            getBudgetDeclearData();
        });

    </script>
@endsection