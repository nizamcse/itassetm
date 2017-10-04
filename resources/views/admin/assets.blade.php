@extends('layouts.admin')
@section('content')
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="assetForm" action="{{ route('post.assets-json') }}" method="post">
                {{ csrf_field() }}
                <input type="text" name="astid" value="" class="hide">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Old Code</label>
                            <input type="text" class="form-control" name="asset_old_cd" value="" placeholder="Asset Old Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Asset Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Type</label>
                            <select name="asset_type" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Type</option>
                                @foreach($assets_type as $asset_type)
                                    <option value="{{ $asset_type->id }}">{{ $asset_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Manufacturer</label>
                            <select name="asset_manufac" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Manufacturer</option>
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
                            <label>Asset Department</label>
                            <select id="assetDepartment" name="asset_dept" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Section</label>
                            <select id="assetSection" name="asset_sec" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Employee</label>
                            <select id="assetEmployee" name="asset_emp" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Employee</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Description</label>

                            <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="formgroup">
                            <label>Life Time</label>
                            <input type="text" class="form-control" name="asset_life" value="" placeholder="Number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Unit</label>

                            <select name="asset_life_unit" class="form-control select2" style="width: 100%" ;="">
                                <option value="0">Choose Life Unit </option>
                                @foreach($units_of_measurement as $unit_of_measurement)
                                    <option value="{{ $unit_of_measurement->id }}">{{ $unit_of_measurement->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Retainment Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control datepicker" name="asset_retainment_dt" value="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for=""></label>
                        <div class="form-group">
                            <button id="saveAsset" type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="assetEditForm" action="{{ route('post.assets-update-json') }}" method="post" style="display: none">
                {{ csrf_field() }}
                <input type="text" name="astid" value="" class="hide">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Old Code</label>
                            <input type="text" class="form-control" name="asset_old_cd" value="" placeholder="Asset Old Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Asset Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Type</label>
                            <select name="asset_type" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Type</option>
                                @foreach($assets_type as $asset_type)
                                    <option value="{{ $asset_type->id }}">{{ $asset_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Manufacturer</label>
                            <select name="asset_manufac" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Manufacturer</option>
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
                            <label>Asset Department</label>
                            <select id="assetDepartment" name="asset_dept" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Section</label>
                            <select id="assetSection" name="asset_sec" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asset Employee</label>
                            <select id="assetEmployee" name="asset_emp" class="form-control select2" style="width: 100%" ;="">
                                <option value="">Choose Asset Employee</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Description</label>

                            <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="formgroup">
                            <label>Life Time</label>
                            <input type="text" class="form-control" name="asset_life" value="" placeholder="Number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Lifge Unit</label>

                            <select name="asset_life_unit" class="form-control select2" style="width: 100%" ;="">
                                <option value="0">Choose Life Unit </option>
                                @foreach($units_of_measurement as $unit_of_measurement)
                                    <option value="{{ $unit_of_measurement->id }}">{{ $unit_of_measurement->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Retainment Date</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control datepicker" name="asset_retainment_dt" value="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button id="cancelAsset" type="button" class="btn btn-success btn-cancel-edit btn-warning">Cancel</button>
                            <button id="updateAsset" type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="assetsList"></div>
    </div>
    <div class="box-footer">

    </div>
@endsection

@section('script')
    @include('../partials.asset-list')
    <script>

        $(document).ready(function () {
            $('select[name=asset_dept]').on('change', function() {
                var dept  = this.value;
                assetEmployee(dept);
            });

            $("#assetEditForm").css({"display":"none"});

            function showEmployeeDropdown(employees) {
                var $employeeOption = '<option value="">Select Employee</option>';
                employees.forEach(function (employee) {
                    $employeeOption += '<option value="'+employee.id+'">'+employee.name+'</option>';
                });

                $('select#assetEmployee').html($employeeOption);
                $('select#assetEmployee').html($employeeOption);
            }

            function assetEmployee(dept) {
                var url = "{{ route('json-assets-employee') }}";
                if(dept){
                    url +="/"+dept;
                }
                $.ajax({
                    url: url,
                    success: function(result){
                        showEmployeeDropdown(result.employees);
                    }
                });
            }

            function assetsList() {
                var url = "{{ route('assets-json') }}";
                $.ajax({
                    url: url,
                    success: function(result){
                        showAssetInTable(result);
                    }
                });
            }

            function showAssetInTable(data) {
                var theTemplateScript = $("#assets-list-template").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#assetsList').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#assetsListData').DataTable();
            }


            $("#assetForm" ).submit(function( event ) {
                $('#saveAsset').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                console.log(url);
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#saveAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#assetForm" )[0].reset();
                    assetsList();
                }).error(function (xhr, status, error) {
                    $('#saveAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });
            $("#assetEditForm" ).submit(function( event ) {
                $('#updateAsset').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                console.log(url);
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updateAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#assetEditForm" )[0].reset();
                    $("#assetEditForm").css({"display":"none"});
                    $("#assetForm").css({"display":"block"});
                    assetsList();
                }).error(function (xhr, status, error) {
                    $('#updateAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });
            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('json-delete-assets') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        assetsList();
                    }
                });
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#assetForm").css({"display":"none"});
                $("#assetEditForm").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('json-get-asset') }}/"+item;
                var formUrl = "{{ route('post.assets-update-json') }}/"+item;
                $("#assetEditForm").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        $("#assetEditForm input[name=asset_old_cd]").val(data.asset.asset_old_cd);
                        $("#assetEditForm input[name=name]").val(data.asset.name);
                        $("#assetEditForm select[name=asset_type]").val(data.asset.asset_type);
                        $("#assetEditForm select[name=asset_manufac]").val(data.asset.asset_manufac);

                        $("#assetEditForm select[name=asset_dept]").val(data.asset.asset_dept);
                        $("#assetEditForm select[name=asset_sec]").val(data.asset.asset_sec);
                        $("#assetEditForm select[name=asset_emp]").val(data.asset.asset_emp);
                        $("#assetEditForm textarea[name=description]").val(data.asset.description);
                        $("#assetEditForm input[name=asset_life]").val(data.asset.asset_life);
                        $("#assetEditForm select[name=asset_life_unit]").val(data.asset.asset_life_unit);
                        $("#assetEditForm input[name=asset_retainment_dt]").val(data.asset.asset_retainment_dt);
                    }
                });
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#assetEditForm").css({"display":"none"});
                $("#assetForm").css({"display":"block"});
            });

            assetEmployee(null);
            assetsList();

            $('.datepicker').datepicker();
        });

    </script>
@endsection