@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Details</h3>
            <div class="box-tools pull-right">
                <button id="addEmployee" type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>Add New Employee</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="employee-form" action="{{ route('post.employee') }}" method="POST">
                {{ csrf_field() }}
                <div id="section-input-area">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee Code</label>
                                <input type="text" class="form-control" name="employee_code" value="" placeholder="Employee Code" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control" name="name" value="" placeholder="Employee Name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" value="" placeholder="Designation">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="Employeedatepicker3" name="joining_date" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_department">Department</label>
                                <select id="employee_department" name="employee_dept" class="form-control select2" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_section">SEction</label>
                                <select id="employee_section" name=employee_section" class="form-control select2" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_location">Location</label>
                                <select id="employee_location" name="employee_location" class="form-control select2" style="width: 100%">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="cancelEmployeeForm" type="button" class="btn btn-success">Cancel</button>
                <button type="submit" class="btn btn-success save-section">Save</button>
            </form>
            <form id="employee-edit-form" action="{{ route('post.employee') }}" method="POST">
                {{ csrf_field() }}
                <div id="section-input-area">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee Code</label>
                                <input type="text" class="form-control" name="employee_code" value="" placeholder="Employee Code" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control" name="name" value="" placeholder="Employee Name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" value="" placeholder="Designation">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="Employeedatepicker3" name="joining_date" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_employee_department">Department</label>
                                <select id="edit_employee_department" name="employee_dept" class="form-control select2" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_employee_section">SEction</label>
                                <select id="edit_employee_section" name="employee_section" class="form-control select2" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_employee_location">Location</label>
                                <select id="edit_employee_location" name="employee_location" class="form-control select2" style="width: 100%">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="cancelEmployeeEditForm" type="button" class="btn btn-success">Cancel</button>
                <button type="submit" class="btn btn-success save-section">Save</button>
            </form>
        </div>

        <!-- /.row -->
    </div>
    <div class="x_content">
        <div id="employees"></div>
    </div>
    <div class="box-footer">

    </div>
@endsection

@section('script')
    @include('../partials.employees-list')
    <script>

        $("#employee-form").css({"display":"none"});
        $("#addEmployee").click(function () {
            $("#employee-form").css({"display":"block"});
            $("#employee-edit-form").css({"display":"none"});
        });
        $("#cancelEmployeeForm").click(function () {
            $("#employee-form").css({"display":"none"});
            $("#employee-form")[0].reset();
        });
        $("#employee-edit-form").css({"display":"none"});

        var employeesData = function (data) {
            Handlebars.registerHelper('ifEquals', function(a, options) {
                if (a) {
                    return options.fn(this);
                }

                return options.inverse(this);
            });

            Handlebars.registerHelper('ifNotEquals', function(a, options) {
                if (a == null) {
                    return options.fn(this);
                }

                return options.inverse(this);
            });

            Handlebars.registerHelper('ifPending', function(a, options) {
                if (a == 0) {
                    return options.fn(this);
                }

                return options.inverse(this);
            });

            Handlebars.registerHelper('ifActive', function(a, options) {
                if (a == 1) {
                    return options.fn(this);
                }

                return options.inverse(this);
            });

            var theTemplateScript = $("#employee-table-template").html();

            // Compile the template
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#employees').html(theCompiledHtml);
            initializeDatatable();

        };
        function initializeDatatable() {
            $('#employeeDatatable').DataTable();
        }

        var getEmployeesList = function (){
            $.ajax({url: "{{ route('json-employees') }}", success: function(result){
                console.log(result);
                employeesData(result);
            }});
        };

        var getEmployee = function (id){
            $.ajax({url: "{{ route('json-employee') }}/"+id, success: function(result){
                var url = "{{ route('post.json-employee') }}/"+result.employee.id;
                $("#employee-edit-form").css({"display":"block"});
                $("#employee-form").css({"display":"none"});
                $("#employee-edit-form").attr('action',url);
                $("#employee-edit-form input[name='name']").val(result.employee.name);

                $("#employee-edit-form input[name='employee_code']").val(result.employee.employee_code);

                $("#employee-edit-form input[name='joined_at']").val(result.employee.joined_at);

                $("#employee-edit-form input[name='phone']").val(result.employee.phone);

                $("#employee-edit-form input[name='email']").val(result.employee.email);

                $("#employee-edit-form input[name='designation']").val(result.employee.designation);

                $("#employee-edit-form select[name='employee_dept']").val(result.employee.dept_id);

                $("#employee-edit-form select[name='employee_section']").val(result.employee.section_id);

                $("#employee-edit-form select[name='employee_location']").val(result.employee.location_id);

            }});
        };

        $("#employee-form" ).on( "submit", function( event ) {
            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                getEmployeesList();
                $("#employee-form" )[0].reset();
                $("#employee-form" ).css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            event.preventDefault();
        });

        $("#employee-edit-form" ).on( "submit", function( event ) {
            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                getEmployeesList();
                $("#employee-edit-form" )[0].reset();
                $("#employee-edit-form" ).css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            event.preventDefault();
        });

        function setDepartment() {
            var url = "{{ route('json-department') }}";
            $.ajax({
                type        : 'GET',
                url         : url,
                encode          : true
            }).done(function(data) {
                var $departmentsOptions = '<option value="">Select Department</option>';
                data.departments.forEach(function (dept) {
                    console.log(dept);
                    $departmentsOptions +='<option value="'+dept.id+'">'+dept.name+'</option>'
                });
                $("#edit_employee_department").html($departmentsOptions);
                $("#employee_department").html($departmentsOptions);
            });
        }
        function setSection() {
            var url = "{{ route('json-section') }}";
            $.ajax({
                type        : 'GET',
                url         : url,
                encode          : true
            }).done(function(data) {
                var $departmentsOptions = '<option value="">Select Section</option>';
                data.sections.forEach(function (section) {
                    $departmentsOptions +='<option value="'+section.id+'">'+section.name+'</option>'
                });

                $("#employee_section").html($departmentsOptions);
                $("#edit_employee_section").html($departmentsOptions);
            });
        }
        function setLocation() {
            var url = "{{ route('json-location') }}";
            $.ajax({
                type        : 'GET',
                url         : url,
                encode      : true
            }).done(function(data) {
                var $departmentsOptions = '<option value="">Select Location</option>';
                data.locations.forEach(function (location) {
                    $departmentsOptions +='<option value="'+location.id+'">'+location.name+'</option>'
                });
                $("#employee_location").html($departmentsOptions);
                $("#edit_employee_location").html($departmentsOptions);
            });
        }

        function editEmployee(elem) {
            getEmployee(elem.data('id'));
        }

        function deleteEmployee(elem) {
            var url = "{{ route('json-delete-employee') }}/"+elem.data('id');

            $.ajax({
                type        : 'GET',
                url         : url,
                encode      : true
            }).done(function(data) {
                console.log(data);
                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getEmployeesList();
            });
        }

        $("#cancelEmployeeEditForm").click(function () {
            $("#employee-edit-form")[0].reset();
            $("#employee-edit-form").css({"display":"none"});
        });

        getEmployeesList();
        setDepartment();
        setSection();
        setLocation();


    </script>
@endsection