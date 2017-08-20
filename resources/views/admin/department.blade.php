@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <p><a href="#" id="addDepartment" class="btn btn-info">Add More</a></p>
            <div class="add-department-wraper">
                <form id="department-form" action="{{ route('post.department') }}" method="post">
                    {{ csrf_field() }}
                    <div id="department-input-area">

                    </div>
                    <!-- /.row -->
                    <button type="submit" class="btn btn-danger bt-cancel-add-department">Cancel</button>
                    <button type="submit" class="btn btn-success bt-save-department">Save</button>
                </form>
            </div>
            <div class="edit-department-wraper">
                <form id="edit-department-form" action="#" method="post">
                    {{ csrf_field() }}
                    <input class="hide" type="text" name="deptid" value="">
                    <div id="department-input-area">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input type="text" class="form-control" name="name" value="" placeholder="Section Name" required="">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Section S.V </label>

                                    <select id="edit_report_to_employee" name="reporting_to" class="form-control select2" style="width: 100%" ;="">
                                        <option value="">Reporting To</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <button type="button" class="btn btn-success bt-cancel-update">Cancel</button>
                    <button type="submit" class="btn btn-success bt-update-department">Save</button>
                </form>
            </div>

        </div>
        <div class="x_content" id="departments">

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
    </div>
@endsection

@section('script')
    @include('../partials.department-list-table')
    <script>
        var $departmentOption;

        var departmentDataTable = function(){
            $('#datatable').DataTable( {
                "paging":   true,
                "ordering": true,
                "info":     true
            } );
        };
        var testFn = function (data) {
            // Register a helper
            Handlebars.registerHelper('capitalize', function(str){
                // str is the argument passed to the helper when called
                str = str || '';
                return str.slice(0,1).toUpperCase() + str.slice(1);
            });
            // Grab the template script
            var theTemplateScript = $("#built-in-helpers-template").html();

            // Compile the template
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#departments').html(theCompiledHtml);
            departmentDataTable();

        };

        var getDepartments = function(){
            $.ajax({url: "{{ route('json-department') }}", success: function(result){
                testFn(result);
            }});
        };

        $( "#department-form" ).on( "submit", function( event ) {

            var formData = $( this ).serialize();
            console.log(formData);
            var url = $( this ).attr('action');

            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                console.log(data);
                getDepartments();
                $( "#department-form" )[0].reset();
                $( "#department-form" ).css({"display":"none"});
                initForm();

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                $("#department-form #department-input-area").html('');
            });
            event.preventDefault();
        });
        $("#edit-department-form").on( "submit", function( event ) {

            var formData = $( this ).serialize();
            console.log(formData);
            var url = $( this ).attr('action');

            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                console.log(data);
                getDepartments();
                $("#edit-department-form")[0].reset();
                $("#edit-department-form").css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            event.preventDefault();
        });

        getDepartments();

        var formField = function () {


            var ind = $("#department-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Department Name</label>';
            var $input1 = '<input type="text" class="form-control" name="department['+ind+'][name]"  placeholder="Department" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Reporting To </label>';
            var $input2 ='<select id="report_to_employee" name="department['+ind+'][reporting_to]" class="form-control select2" style="width: 100%";">';
            $input2 += $departmentOption;
            $input2 += '</select>';
            $fieldColum2 += $input2;
            $fieldColum2 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum2;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#department-input-area").append($fieldHtml);
            if($("#department-input-area").find('.row').length>0){
                $(".bt-save-department").css({
                    "display" : "inline-block"
                });
                $(".bt-cancel-add-department").css({
                    "display" : "inline-block"
                });
            }
            getEmployeesList();
        };


        var initForm = function () {
            var ind = $("#department-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Department Name</label>';
            var $input1 = '<input type="text" class="form-control" name="department['+ind+'][name]"  placeholder="Department" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Reporting To </label>';
            var $input2 ='<select name="department['+ind+'][reporting_to]" class="form-control select2" style="width: 100%";">';
            $input2 += $departmentOption;
            $input2 += '</select>';
            $fieldColum2 += $input2;
            $fieldColum2 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum2;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#department-input-area").html($fieldHtml);
            $(".bt-cancel-add-department").css({
                "display" : "inline-block"
            });
            getEmployeesList();
        }

        $("#addDepartment").click(function () {
            $( "#department-form" ).css({"display":"block"});
            $("#edit-department-form").css({"display":"none"});
            formField();
        });

        function removeRow(element) {
            element.closest('.row').remove();
            if($("#department-input-area").find('.row').length<=0){
                $(".bt-save-department").css({
                    "display" : "none"
                });
                $(".bt-cancel-add-department").css({
                    "display" : "none"
                });
            }
        }
        $(".bt-save-department").css({
            "display" : "none"
        });

        function editDepartment(elem){
            $("#edit-department-form").attr("action","{{ route('json-update-department') }}/"+elem.data('id'));
            $("#edit-department-form").css({"display":"block"});
            $("#edit-department-form input[name='name']").val(elem.data('name'));
            $("#department-form").css({"display":"none"});
            getEmployeesList();
            $('#edit-department-form #edit_report_to_employee option[value="'+elem.data('report')+'"]').prop('selected', true);
        }

        function deleteDepartment(elem) {
            var url = "{{ route('json-delete-department') }}/"+elem.data('id');

            $.ajax({
                type        : 'GET',
                url         : url,
                encode          : true
            }).done(function(data) {
                console.log(data);
                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getDepartments();
            });
        }

        $(".bt-cancel-update").click(function () {
            $("#edit-department-form").css({"display":"none"});
        });
        $(".bt-cancel-add-department").click(function () {
            $("#department-form").css({"display":"none"});
            $("#department-form #department-input-area").html('');
        });
        $("#edit-department-form").css({"display":"none"});
        $( "#department-form" ).css({"display":"none"});

        var getEmployeesList = function (){
            $.ajax({url: "{{ route('json-employees') }}", success: function(result){
                $departmentOption = '<option value="">Select Department</option>';
                result.employees.forEach(function (employee) {
                    $departmentOption +='<option value="'+employee.id+'">'+employee.name+'</option>'
                });
            }});
            $("#edit-department-form #edit_report_to_employee").html($departmentOption);
        };

        getEmployeesList();



    </script>
@endsection
