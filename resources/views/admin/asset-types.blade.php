@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Asset Type</h3>
            <div class="box-tools pull-right">
                <button type="button" id="addAsset" class="btn btn-info flat btn-sm">Add Assets</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- /.row -->
            <div id="submit-status"></div>
            <form id="asset-type-form" action="{{ route('post.assets') }}" method="POST">
                {{ csrf_field() }}
                <div id="section-input-area"></div>
                <button id="cancelAssetForm" type="button" class="btn btn-danger flat btn-sm">Cancel</button>
                <button type="submit" class="btn btn-success save-section flat btn-sm">Save</button>
            </form>
            <form id="asset-type-edit-form" action="{{ route('post.location') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Asset Type</label>
                            <input type="text" class="form-control" name="name"  placeholder="Asset Name" required="">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Asset Type Parent</label>
                            <select id="parent_id" name="parent_id" class="form-control select2" style="width: 100%">

                            </select>
                        </div>
                    </div>
                </div>
                <button id="cancelAssetTypeEditForm" type="button" class="btn btn-danger flat">Cancel</button>
                <button type="submit" class="btn btn-success flat save-section">Save</button>
            </form>
        </div>
        <div class="x_content">
            <div id="assets"></div>
        </div>
    </div>
@endsection

@section('script')
    @include('../partials.asset-types')
    <script>
        var $assetOptions;
        $("#asset-type-form").css({"display":"none"});
        $("#asset-type-edit-form").css({"display":"none"});

        $("#cancelAssetForm").click(function(){
            $("#asset-type-form").css({"display":"none"});
            $("#section-input-area").html('');
        });

        $("#cancelAssetTypeEditForm").click(function(){
            $("#asset-type-edit-form").css({"display":"none"});
        });

        var assetsData = function (data) {

            var theTemplateScript = $("#assets-data-template").html();

            // Compile the template
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#assets').html(theCompiledHtml);
            initializeDatatable();

        };

        function initializeDatatable() {
            $('#assetsData').DataTable();
        }

        var getAssetList = function (){
            $.ajax({url: "{{ route('json-assets') }}", success: function(result){
                assetsData(result);
            }});
        };

        var assetTree = function peintTree(){

            $.ajax({url: "{{ route('asset-tree') }}", success: function(result){
                $assetOptions = result;
            }});
        };

        var formField = function () {
            var ind = $("#section-input-area").find('.row').length;
            var $fieldHtml = '<div class="row">';
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Asset Name</label>';
            var $input1 = '<input type="text" class="form-control" name="assets['+ind+'][name]"  placeholder="Asset Name" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Asset Parent </label>';
            var $input2 ='<select name="assets['+ind+'][parent_id]" class="form-control select2" style="width: 100%";">';
            var $input2Data = '<option value="">TOP</option>';
            $input2Data += $assetOptions;
            $input2 += $input2Data;
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
            var $fieldColum1 = '<div class="col-sm-5"><div class="form-group"><label>Asset Name</label>';
            var $input1 = '<input type="text" class="form-control" name="assets['+ind+'][name]"  placeholder="Asset Name" required="">';
            $fieldColum1 += $input1;
            $fieldColum1 += '</div></div>';
            var $fieldColum2 = '<div class="col-sm-5"><div class="form-group"><label>Asset Parent </label>';
            var $input2 ='<select name="assets['+ind+'][parent_id]" class="form-control select2" style="width: 100%";">';
            var $input2Data = '<option value="">TOP</option>';
            $input2Data += $assetOptions;
            $input2 += $input2Data;
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
                $("#asset-type-form").css({"display":"none"});
            }
        }

        function editAsset(elem){
            $("#asset-type-edit-form").attr("action","{{ route('json-update-asset') }}/"+elem.data('id'));

            $("#asset-type-form").css({"display":"none"});
            $("#asset-type-edit-form").css({"display":"block"});

            $("#asset-type-edit-form input[name='name']").val(elem.data('name'));
            var $input2Data = '<option value="">TOP</option>';
            $input2Data += $assetOptions;

            $("#asset-type-edit-form #parent_id").html($input2Data);

            $('#asset-type-edit-form #parent_id option[value="'+elem.data('parent')+'"]').prop('selected', true);
        }

        function deleteAsset(elem) {
            var url = "{{ route('json-delete-asset') }}/"+elem.data('id');

            $.ajax({
                type        : 'GET',
                url         : url,
                encode      : true
            }).done(function(data) {
                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
                getAssetList();
            });
        }

        $( "#asset-type-form" ).on( "submit", function( event ) {
            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                getAssetList();
                assetTree();
                $( "#asset-type-form" )[0].reset();
                $( "#asset-type-form" ).css({"display":"none"});
                $("#section-input-area").html('');

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            event.preventDefault();
        });

        $("#asset-type-edit-form").on( "submit", function( event ) {

            var formData = $( this ).serialize();
            var url = $( this ).attr('action');
            $.ajax({
                type        : 'POST',
                url         : url,
                data        : formData,
                encode          : true
            }).done(function(data) {
                getAssetList();
                $("#asset-type-edit-form")[0].reset();
                $("#asset-type-edit-form").css({"display":"none"});

                $msg = '<div class="alert alert-success">'+data.message+'</div>';
                $("#submit-status").html($msg);
            });
            assetTree();
            event.preventDefault();
        });

        $("#addAsset").click(function () {
            formField();
            $("#asset-type-form").css({"display":"block"});

        });

        function assetWithChild(){
             
        }

        getAssetList();
        assetTree();


    </script>
@endsection