@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Manufacturers</h3>

            <div class="box-tools pull-right">
                <button class="btn-primary btn" id="addManufacturer">Add Manufacturers</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="manufacturer-form" action="{{ route('post.json-manufacturer') }}" method="POST">
                {{ csrf_field() }}
                <div id="manufacturer-input-area"></div>
                <button id="cancelManufacturerForm" type="button" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
            <form id="manufacturer-edit-form" action="#" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nameEdit">Manufacturer Name</label>
                    <input class="form-control" type="text" name="name" id="nameEdit">
                </div>
                <button id="cancelManufacturerEditForm" type="button" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
            <!-- /.row -->
        </div>
        <div class="x_content">
            <div id="manufacturer"></div>
        </div>
    </div>
@endsection

@section('script')
    @include('../partials.manufacturer')
    <script>
        $("#manufacturer-form").css({"display":"none"});
        $("#manufacturer-edit-form").css({"display":"none"});

        $("#cancelManufacturerForm").click(function(){
            $("#manufacturer-form").css({"display":"none"});
            $("#manufacturer-input-area").html('');
        });


        $("#cancelManufacturerEditForm").click(function(){
            $("#manufacturer-edit-form").css({"display":"none"});
        });

        var manufacturerData = function (data) {

            var theTemplateScript = $("#manufacturer-data-template").html();

            // Compile the template
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#manufacturer').html(theCompiledHtml);

        };

        var formField = function () {
            var ind = $("#manufacturer-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Manufacturer</label>';
            var $input1 = '<input type="text" class="form-control" name="manufacturer['+ind+'][name]"  placeholder="Manufacturer" required>';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#manufacturer-input-area").append($fieldHtml);

        };

        var initForm = function () {
            $("#manufacturer-input-area").html('');
            var ind = $("#manufacturer-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Manufacturer Name</label>';
            var $input1 = '<input type="text" class="form-control" name="manufacturer['+ind+'][name]"  placeholder="Manufacturer" required>';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';

            var $fieldColum3 = '<div class="col-sm-2"><button class="btn-danger btn-remove-row" type="button" style="margin-top:30px" onclick="removeRow($(this))">Remove</button></div>';

            $fieldHtml += $fieldColum1;
            $fieldHtml += $fieldColum3;
            $fieldHtml += '</div>';

            $("#manufacturer-input-area").html($fieldHtml);
        }

        $("#addManufacturer").click(function () {
            $("#manufacturer-form").css({"display":"block"});
            formField();
        });

        function removeRow(element) {
            element.closest('.row').remove();
            var ind = $("#manufacturer-input-area").find('.row').length;
            if(ind<=0){
                $("#manufacturer-form").css({"display":"none"});
            }
        }

        $( "#manufacturer-form" ).on( "submit", function( event ) {
            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                $( "#manufacturer-form" )[0].reset();
                $( "#manufacturer-form" ).css({"display":"none"});
                $("#manufacturer-input-area").html('');

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getManufacturerList();
            });
            event.preventDefault();
        });

        $("#manufacturer-edit-form").on( "submit", function( event ) {

            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                $("#manufacturer-edit-form")[0].reset();
                $("#manufacturer-edit-form").css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getManufacturerList();
            });
            event.preventDefault();
        });

        function editManufacturer(elem){
            $("#manufacturer-edit-form").attr("action","{{ route('json-update-manufacturer') }}/"+elem.data('id'));

            $("#manufacturer-form").css({"display":"none"});
            $("#manufacturer-edit-form").css({"display":"block"});

            $("#manufacturer-edit-form input[name='name']").val(elem.data('name'));
        }

        function deleteManufacturer(elem) {
            var url = "{{ route('json-delete-manufacturer') }}/"+elem.data('id');

            $.ajax({
                type        : 'GET',
                url         : url,
                encode      : true
            }).done(function(data) {
                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getManufacturerList();
            });
        }

        var getManufacturerList = function (){
            $.ajax({url: "{{ route('json-manufacturer') }}", success: function(result){
                manufacturerData(result);
            }});

        };

        getManufacturerList();

    </script>
@endsection