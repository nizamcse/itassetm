@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">SECTION</h3>

            <div class="box-tools pull-right">
                <a href="#" id="addSection" class="btn flat btn-info btn-xs">Add Section</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="section-form" action="{{ route('post.section') }}" method="POST" style="display:none;">
                {{ csrf_field() }}
                <div id="section-input-area"></div>
                <button id="cancelSectionForm" type="button" class="btn btn-danger flat btn-sm">Cancel</button>
                <button type="submit" class="btn flat btn-sm btn-success save-section">Save</button>
            </form>
            <form id="section-edit-form" action="#" method="POST" style="display: none">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Section Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Section Name" required="">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Section S.V </label>

                            <select id="employee_id" name="employee_id" class="form-control select2" style="width: 100%" ;="">
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <button id="cancelSectionEditForm" type="button" class="btn btn-success">Cancel</button>
                <button type="submit" class="btn btn-success update-section">Save</button>
            </form>
            <!-- /.row -->
        </div>
        <div class="x_content">

            <div id="sections"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">


        </div>
    </div>
@endsection

@section('script')
    @include('../partials.section-list-table')
    <script>
        var $supervisorOption;
        $("#section-form").css({"display":"none"});
        $("#cancelSectionForm").click(function(){
            $("#section-form").css({"display":"none"});
        });
        $("#get-edit-section").click(function () {
            $("#section-form").css({"display":"none"});
            $("#section-edit-form").css({"display":"block"});
        });
        $("#cancelSectionEditForm").click(function(){
            $("#section-edit-form").css({"display":"none"});
        });

        var sectionData = function (data) {

            var theTemplateScript = $("#section-data-template").html();

            // Compile the template
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#sections').html(theCompiledHtml);

        };

        var formField = function () {
            var ind = $("#section-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Section Name</label>';
            var $input1 = '<input type="text" class="form-control" name="section['+ind+'][name]"  placeholder="Department" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Section Supervisor </label>';
            var $input2 ='<select name="section['+ind+'][employee_id]" class="form-control select2" style="width: 100%";">';
            $input2 += $supervisorOption;
            $input2 += '</select>';
            $fieldColum2 += $input2;
            $fieldColum2 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum2;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#section-input-area").append($fieldHtml);
            getEmployeesList();

        };

        var initForm = function () {
            var ind = $("#section-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Section Name</label>';
            var $input1 = '<input type="text" class="form-control" name="section['+ind+'][name]"  placeholder="Department" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Section Supervisor </label>';
            var $input2 ='<select name="section['+ind+'][employee_id]" class="form-control select2" style="width: 100%";">';
            $input2 += $supervisorOption;
            $input2 += '</select>';
            $fieldColum2 += $input2;
            $fieldColum2 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum2;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#department-input-area").html($fieldHtml);
            getEmployeesList();
        }

        $("#addSection").click(function () {
            $("#section-form").css({"display":"block"});
            formField();
        });

        function removeRow(element) {
            element.closest('.row').remove();
            var ind = $("#section-input-area").find('.row').length;
            if(ind<=0){
                $("#section-form").css({"display":"none"});
            }
        }

        function getSections(){
            $.ajax({url: "{{ route('json-section') }}", success: function(result){
                sectionData(result);
            }});
        }

        $( "#section-form" ).on( "submit", function( event ) {
            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                getSections();
                $( "#section-form" )[0].reset();
                $( "#section-form" ).css({"display":"none"});
                initForm();

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            event.preventDefault();
        });

        $("#section-edit-form").on( "submit", function( event ) {

            var formData = $( this ).serialize();
            console.log(formData);
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                getSections();
                $("#section-edit-form")[0].reset();
                $("#section-edit-form").css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            event.preventDefault();
        });

        function editSection(elem){
            $("#section-edit-form").attr("action","{{ route('json-update-section') }}/"+elem.data('id'));
            $("#section-edit-form").css({"display":"block"});
            $("#section-edit-form input[name='name']").val(elem.data('name'));
            getEmployeesList();
            $("#section-edit-form #employee_id").html($supervisorOption);
            $('#section-edit-form #employee_id option[value="'+elem.data('supervisor')+'"]').prop('selected', true);
        }

        function deleteSection(elem) {
            var url = "{{ route('json-delete-section') }}/"+elem.data('id');

            $.ajax({
                type        : 'GET',
                url         : url,
                encode      : true
            }).done(function(data) {
                console.log(data);
                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getSections();
            });
        }

        var getEmployeesList = function (){
            $.ajax({url: "{{ route('json-employees') }}", success: function(result){

                $supervisorOption = '<option value="">Select Supervisor</option>';
                result.employees.forEach(function (employee) {
                    $supervisorOption +='<option value="'+employee.id+'">'+employee.name+'</option>'
                });
            }});

        };

        getEmployeesList();

        getSections();

    </script>
@endsection