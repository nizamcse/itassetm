@extends('layouts.admin')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Asset Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form id="subAssetForm" action="{{ route('sub-assets') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Old Code</label>
                            <input type="text" class="form-control" name="sub_asset_old_code" value="" placeholder="Sub Asset Old Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Code</label>
                            <input type="text" class="form-control" name="suba_asset_cd" value="" placeholder="Sub Asset Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Sub Asset Name">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="suba_des" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Time</label>
                            <input type="text" class="form-control" name="suba_lifetime" value="" placeholder="Number">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Unit</label>
                            <select name="suba_life_unit" class="form-control select2" style="width: 100%" ;>
                                <option value="0">Choose Life Unit</option>
                                <option value="1">Day</option>
                                <option value="2">Month</option>
                                <option value="3">Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Retainment Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" id="suba_retainment_dt" name="suba_retainment_dt">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" id="saveSubAsset" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="subAssetEditForm" action="{{ route('sub-assets') }}" method="post" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Old Code</label>
                            <input type="text" class="form-control" name="sub_asset_old_code" value="" placeholder="Sub Asset Old Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Code</label>
                            <input type="text" class="form-control" name="suba_asset_cd" value="" placeholder="Sub Asset Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Sub Asset Name">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="suba_des" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Time</label>
                            <input type="text" class="form-control" name="suba_lifetime" value="" placeholder="Number">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Unit</label>
                            <select name="suba_life_unit" class="form-control select2" style="width: 100%" ;>
                                <option value="0">Choose Life Unit</option>
                                <option value="1">Day</option>
                                <option value="2">Month</option>
                                <option value="3">Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Retainment Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" id="suba_retainment_dt" name="suba_retainment_dt">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="button"  class="btn btn-warning btn-cancel-edit">Cancel</button>
                            <button type="submit" id="updateSubAsset" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">
        <div id="subAssets"></div>
    </div>
    <div class="box-footer">

    </div>
@endsection

@section('script')
    @include('../partials.sub-assets')
    <script>
        $(document).ready(function () {
            $("#subAssetForm" ).submit(function( event ) {
                $('#saveSubAsset').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#saveSubAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#subAssetForm" )[0].reset();
                    getSUbAsset();
                }).error(function (xhr, status, error) {
                    $('#saveSubAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            function subAssetData(data) {
                var theTemplateScript = $("#sub-assets-list").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#subAssets').html(theCompiledHtml);
            }

            function getSUbAsset(){
                $.ajax({url: "{{ route('json-sub-assets') }}", success: function(result){
                    subAssetData(result);
                }});
            }

            $(document).on('click', '.btn-delete', function (e) {
                var item = $(this).data('id');
                var url = "{{ route('json-delete-sub-assets') }}/"+item;
                $.ajax({
                    url: url,
                    success: function(data){
                        var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                        $("#submit-status").html($msg);
                        getSUbAsset();
                    }
                });
            });

            $(document).on('click', '.btn-edit', function (e) {
                $("#subAssetForm").css({"display":"none"});
                $("#subAssetEditForm").css({"display":"block"});
                var item = $(this).data('id');
                var url = "{{ route('json-get-sub-asset') }}/"+item;
                var formUrl = "{{ route('sub-asset-update-json') }}/"+item;
                $("#subAssetEditForm").attr('action',formUrl);
                $.ajax({
                    url: url,
                    success: function(data){
                        $("#subAssetEditForm input[name=sub_asset_old_code]").val(data.sub_asset.sub_asset_old_code);
                        $("#subAssetEditForm input[name=suba_asset_cd]").val(data.sub_asset.suba_asset_cd);
                        $("#subAssetEditForm input[name=name]").val(data.sub_asset.suba_name);
                        $("#subAssetEditForm textarea[name=suba_des]").val(data.sub_asset.suba_des);
                        $("#subAssetEditForm input[name=suba_lifetime]").val(data.sub_asset.suba_lifetime);
                        $("#subAssetEditForm select[name=suba_life_unit]").val(data.sub_asset.suba_life_unit);
                        $("#subAssetEditForm input[name=suba_retainment_dt]").val(data.sub_asset.suba_retainment_dt);
                    }
                });
            });

            $(document).on('click', '.btn-cancel-edit', function (e) {
                $("#subAssetEditForm").css({"display":"none"});
                $("#subAssetForm").css({"display":"block"});
            });

            $("#subAssetEditForm").submit(function( event ) {
                $('#updateSubAsset').prop('disabled' ,true);
                var formData = $( this ).serialize();

                var url = $( this ).attr('action');
                console.log(url);
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $('#updateSubAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#subAssetEditForm" )[0].reset();
                    $("#subAssetEditForm").css({"display":"none"});
                    $("#subAssetForm").css({"display":"block"});
                    getSUbAsset();
                }).error(function (xhr, status, error) {
                    $('#updateSubAsset').prop('disabled' ,false);
                    var $msg = '<div class="alert alert-danger">Something went wrong. Please check your internet connection or fill the form appropiately</div>';
                    $("#submit-status").html($msg);
                });
                event.preventDefault();
            });

            getSUbAsset();
        });


    </script>
@endsection