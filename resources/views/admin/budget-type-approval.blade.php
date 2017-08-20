@extends('layouts.admin')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <div id="selectBudgetType">
                <h3>Select Budget Type</h3>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <select id="budget_type_name" name="budget_type_name"  class="form-control">
                                <option value="">Select Budget Type</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">{{ $budget_type->budget_type_name }} - {{ $budget_type->budget_type_year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p id="warn-text" class="text-warning"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="submit-status"></div>
            <form id="serviceTypeApprovalEmployeeForm" action="#" method="POST" style="display: none">
                {{ csrf_field() }}
                <table id="serviceTypeApprovalEmployeeFormTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><label>Select Employee</label></th>
                        <th><label>Approval Level</label></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            <select name="budget_type_app_emp[0][employee_id]"  class="form-control service_type_type budget_type_app_emp">
                            </select>
                        </td>
                        <td><input class="form-control service_type_name" name="budget_type_app_emp[0][level]" type="text" placeholder="Approval Level" /></td>
                    </tr>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <button id="submitEmp" class="btn btn-success btn-add" type="submit">
                                Save
                            </button>
                        </td>
                    </tr>
                    </tfoot>

                </table>
            </form>
            <form id="serviceTypeApprovalEmployeeEditForm" action="#" method="POST" style="display: none">
                {{ csrf_field() }}
                <table id="serviceTypeApprovalEmployeeFormTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><label>Select Employee</label></th>
                        <th><label>Approval Level</label></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            <select name="employee_id"  class="form-control service_type_type budget_type_app_emp">
                            </select>
                        </td>
                        <td><input class="form-control service_type_name" name="level" type="text" placeholder="Approval Level" /></td>
                    </tr>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <button id="submitEmp" class="btn btn-danger btn-cancel-edit" type="button">Cancel</button>
                            <button id="updateEmp" class="btn btn-success btn-add" type="submit">Update</button>
                        </td>
                    </tr>
                    </tfoot>

                </table>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="budgetTypeEmployeeData"></div>
    </div>
@endsection

@section('script')
    @include('../partials.budget-type-approval')
    <script>

        $(document).ready(function () {

            var employee;
            var employees;
            var Id;

            $("#budget_type_name").on('change',function () {
                Id = this.value;
                resetEmployeeApproval(Id);
            });

            function resetEmployeeApproval(id){
                employee = 0;
                $('table#serviceTypeApprovalEmployeeFormTable >tbody').find("tr:gt(0)").remove();
                $("#serviceTypeApprovalEmployeeEditForm").css({"display" : "none"});
                if(id)
                {
                    var url = "{{ route('budget-type-approval') }}/"+id;
                    $("#serviceTypeApprovalEmployeeForm").attr('action',url);
                    getBudgetTypesApprovalEmployee(id);
                    getBudgetTypeEmployee(id);
                    $("#serviceTypeApprovalEmployeeForm").css({"display" : "block"});
                }
                else{
                    $("#serviceTypeApprovalEmployeeForm").css({"display" : "none"});
                }
            }

            function budgetTypeEmployeeData(data) {
                var theTemplateScript = $("#budget-type-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#budgetTypeEmployeeData').html(theCompiledHtml);
                initializeDatatable();
            }
            function initializeDatatable() {
                $('#budgetTypeApprovalData').DataTable();
            }

            function getBudgetTypeEmployee(id){
                $.ajax({url: "{{ route('json-budget-type-approval-employee') }}/"+id, success: function(result){
                    budgetTypeEmployeeData(result);
                }});
            }

            function secOptionEmployee() {
                $('select.budget_type_app_emp').html(employees);
            }
            function getBudgetTypesApprovalEmployee(id){
                $.ajax({url: "{{ route('json-budget-types-employee') }}/"+id, success: function(result){
                    employee = result.level - result.employee;
                    $("#warn-text").html('You have assign <strong>'+result.employee+'</strong> of '+result.level+' approval employee');
                    if(employee>0){
                        $("#serviceTypeApprovalEmployeeForm").css({"display" : "block"});
                    }
                    else{
                        $("#serviceTypeApprovalEmployeeForm").css({"display" : "none"});
                    }
                    employees = '<option value="">Select Employee</option>';
                    result.employees.forEach(function (emp) {
                        employees +='<option value="'+emp.id+'">'+emp.name+'</option>'
                    });

                    secOptionEmployee();
                },error: function () {
                    $("#serviceTypeApprovalEmployeeForm").css({"display" : "none"});
                }});
            }

            var addRows = function () {
                var rowCount = $('table#serviceTypeApprovalEmployeeFormTable >tbody:last >tr').length;
                if(rowCount<employee){
                    var controlForm = $('table#serviceTypeApprovalEmployeeFormTable>tbody');
                    //var currentEntry = '<tr>'+$('table#serviceTypeApprovalEmployeeFormTable>tbody>tr:last').html()+'</tr>';
                    var currentEntry = $('table#serviceTypeApprovalEmployeeFormTable>tbody>tr:last').clone();
                    var newEntry = $(currentEntry).appendTo(controlForm);
                    //newEntry.find('input').val('');
                    newEntry.find('input.service_type_name').attr('name','budget_type_app_emp['+rowCount+'][employee_id]');
                    newEntry.find('select.service_type_type').attr('name','budget_type_app_emp['+rowCount+'][level]');
                    //Remove the Data - as it is cloned from the above

                    //Add the button
                    rowCount = $('table#serviceTypeApprovalEmployeeFormTable >tbody:last >tr').length;
                    if(rowCount > 1) {
                        var removeButtons = document.getElementsByClassName('btn-remove');
                        for(var i = 0; i < removeButtons.length; i++) {
                            removeButtons.item(i).disabled = false;
                        }
                    }
                }
                else{
                    alert("You can assign maximum "+employee+" rmployee");
                }

            };
            $("#addFormRow").click(function (e) {
                e.preventDefault();
                addRows();
            });

            $(document).on('click','.btn-remove',function (e) {
                $(this).parents('tr:first').remove();

                //Disable the Remove Button
                var rowCount = $('table#serviceTypeApprovalEmployeeFormTable >tbody:last >tr').length;
                if(rowCount == 1) {
                    document.getElementsByClassName('btn-remove')[0].disabled = true;
                }

                e.preventDefault();
            });

            $("#serviceTypeApprovalEmployeeForm" ).submit(function( event ) {
                $('#submitEmp').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#submitEmp').prop('disabled' ,false);
                    if(data.status){
                        var cls = 'alert-success';
                    }else{
                        var cls = 'alert-warning';
                    }
                    var $msg = '<div class="alert '+cls+'">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#serviceTypeApprovalEmployeeForm" )[0].reset();
                    resetEmployeeApproval( Id);
                }).error(function (xhr, status, error) {
                    $('#submitEmp').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $("#serviceTypeApprovalEmployeeEditForm" ).submit(function( event ) {
                //$('#updateEmp').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updateEmp').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#serviceTypeApprovalEmployeeEditForm" )[0].reset();
                    $("#serviceTypeApprovalEmployeeEditForm").css({"display":"none"});
                    //resetEmployeeApproval( $("select#budget_type_name").val());
                    //getBudgetTypeEmployee(data.id);
                    resetEmployeeApproval( Id);
                }).error(function (xhr, status, error) {
                    $('#submitEmp').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#serviceTypeApprovalEmployeeEditForm").css({"display":"block"});
                secOptionEmployee();
                var id = $(this).data('id');
                var url = "{{ route('update-budget-type-employee-approval') }}/"+id;
                $("#serviceTypeApprovalEmployeeForm").css({"display":"none"});
                $("#serviceTypeApprovalEmployeeEditForm").attr('action',url);
                $option = '<option value="'+$(this).data('emp')+'">'+$(this).data('name')+'</option>'
                $("#serviceTypeApprovalEmployeeEditForm select[name='employee_id']").append($option);
                $("#serviceTypeApprovalEmployeeEditForm select[name='employee_id']").val($(this).data('emp'));
                $("#serviceTypeApprovalEmployeeEditForm input[name='level']").val($(this).data('order'));
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#serviceTypeApprovalEmployeeEditForm").css({"display":"none"});
                $("#serviceTypeApprovalEmployeeEditForm")[0].reset();
                $("#serviceTypeApprovalEmployeeForm").css({"display":"none"});
                resetEmployeeApproval( Id);

            });

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var budget = $(this).data('budget');
                var url = "{{ route('delete-budget-type-approval') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getBudgetTypeEmployee(budget);
                        resetEmployeeApproval( Id);
                    }
                });
            });
        });

    </script>
@endsection