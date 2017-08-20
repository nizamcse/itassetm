@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Location</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <a href="#" id="addLocation">Add Location</a>
            <form id="location-form" action="{{ route('post.location') }}" method="POST">
                {{ csrf_field() }}
                <div id="section-input-area"></div>
                <button id="cancelLocationForm" type="button" class="btn btn-success">Cancel</button>
                <button type="submit" class="btn btn-success save-section">Save</button>
            </form>
            <form id="location-edit-form" action="{{ route('post.location') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Section Name</label>
                            <input type="text" class="form-control" name="name"  placeholder="Location" required="">
                        </div>
                    </div>
                    <div class="col-sm-5">

                        <div class="form-group">
                            <label>Location Parent</label>
                            <select id="parent_id" name="parent_id" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <button id="cancelLocationEditForm" type="button" class="btn btn-success">Cancel</button>
                <button type="submit" class="btn btn-success save-section">Save</button>
            </form>
            <!-- /.row -->
        </div>
        <div class="x_content">
            <div id="locations"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
        </div>
    </div>
@endsection

@section('script')
    @include('../partials.location-list')
    <script>
        var $locationOption;
        $("#location-form").css({"display":"none"});
        $("#location-edit-form").css({"display":"none"});

        $("#cancelLocationForm").click(function(){
            $("#location-form").css({"display":"none"});
            $("#section-input-area").html('');
        });

        $("#cancelLocationEditForm").click(function(){
            $("#location-edit-form").css({"display":"none"});
        });

        var locationData = function (data) {

            var theTemplateScript = $("#location-data-template").html();

            // Compile the template
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#locations').html(theCompiledHtml);

        };

        var locations = function (){
            $.ajax({url: "{{ route('json-location') }}", success: function(result){
                locationData(result);
            }});
        };
        var LocationTree = function peintTree(){

            $.ajax({url: "{{ route('location-tree') }}", success: function(result){
                $locationOption = result;
            }});
        };
        LocationTree();

        var formField = function () {
            var ind = $("#section-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Section Name</label>';
            var $input1 = '<input type="text" class="form-control" name="location['+ind+'][name]"  placeholder="Location" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Location Parent </label>';
            var $input2 = '<select name="location_parent" class="form-control">';
            $input2 += '<option value="">TOP</option>';
            $input2 += $locationOption;
            $input2 += '</select>';
            $fieldColum2 += $input2;
            $fieldColum2 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum2;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#section-input-area").append($fieldHtml);

        };
        var initForm = function () {
            var ind = $("#section-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Section Name</label>';
            var $input1 = '<input type="text" class="form-control" name="location['+ind+'][name]"  placeholder="Location" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Location Parent </label>';
            var $input2 = '<select name="location_parent" class="form-control">';
            $input2 += '<option value="">TOP</option>';
            $input2 += $locationOption;
            $input2 += '</select>';
            $fieldColum2 += $input2;
            $fieldColum2 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum2;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#section-input-area").html($fieldHtml);

        };

        function removeRow(element) {
            element.closest('.row').remove();
            var ind = $("#section-input-area").find('.row').length;
            if(ind<=0){
                $("#location-form").css({"display":"none"});
            }
        }

        function editLocation(elem){
            $("#location-edit-form").attr("action","{{ route('json-update-location') }}/"+elem.data('id'));

            $("#location-form").css({"display":"none"});
            $("#location-edit-form").css({"display":"block"});

            $("#location-edit-form input[name='name']").val(elem.data('name'));
            var $input2 = '<option value="">TOP</option>';
            $input2 += $locationOption;
            $("#location-edit-form #parent_id").html($input2);
            $('#location-edit-form #parent_id option[value="'+elem.data('parent')+'"]').prop('selected', true);
        }

        function deleteLocation(elem) {
            var url = "{{ route('json-delete-location') }}/"+elem.data('id');

            $.ajax({
                type        : 'GET',
                url         : url,
                encode      : true
            }).done(function(data) {
                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                locations();
            });
        }

        $( "#location-form" ).on( "submit", function( event ) {
            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                locations();
                $( "#location-form" )[0].reset();
                $( "#location-form" ).css({"display":"none"});
                initForm();

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                $("#section-input-area").html('');
                LocationTree();
            });
            event.preventDefault();
        });

        $("#location-edit-form").on( "submit", function( event ) {

            var formData = $( this ).serialize();
            console.log(formData);
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                locations();
                $("#location-edit-form")[0].reset();
                $("#location-edit-form").css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                LocationTree();
            });
            event.preventDefault();
        });

        $("#addLocation").click(function () {
            $("#location-form").css({"display":"block"});
            formField();
        });

        //getLocationList();

        $("#section-input-area-test").click(function () {
            console.log($(this).html());
            alert();
        });

        locations();


    </script>
@endsection