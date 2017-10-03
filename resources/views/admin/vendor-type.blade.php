@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title" style="display: block">
                VENDOR TYPE LIST
                <a href="#" class="btn pull-right flat btn-info btn-xs" data-toggle="modal" data-target="#addVendorType">ADD NEW VENDOR TYPE</a>
            </h3>
        </div>
        <div class="box-body">
            <table id="vendorTypesTable" class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Vendor Type Name</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>

                <tbody id="vendorTypes">
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="editVendorType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="vendor-type-edit" action="#">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Vendor Type</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">NAME</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default flat btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary flat btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addVendorType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="vendor-type-add" action="{{ route('vendor-type') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New Vendor Type</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default flat btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary flat btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    @include('../partials.vendor-type')
    <script>

        $(document).ready(function () {
            $(document).on('click', '.btn-edit-vendor-type',function(e){
                var id = $(this).data('id');
                var url = "{{ route('get-vendor-type') }}/" + id;
                var formUrl = "{{ route('update-vendor-type') }}/" + id;
                $("#vendor-type-edit").attr('action',formUrl);

                $.ajax({url: url, success: function(result){
                    console.log(result);
                    $("#vendor-type-edit input[name=name]").val(result.vendor_type.name);
                }});

            });
            $(document).on('click', '.btn-delete-vendor-type',function(e){
                var id = $(this).data('id');
                var url = "{{ route('delete-vendor-type') }}/" + id;

                $.ajax({url: url, success: function(result){
                    getVendorTypes();
                }});

            });

            $( "#vendor-type-edit" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getVendorTypes();
                    $("#editVendorType").modal('hide');
                });
                event.preventDefault();
            });
            $( "#vendor-type-add" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getVendorTypes();
                    $("#addVendorType").modal('hide');
                });
                event.preventDefault();
            });

            function showVendorTypes (data) {
                var theTemplateScript = $("#vendor-type-lists").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#vendorTypes').html(theCompiledHtml);

            };

            function getVendorTypes(){
                var url = "{{ route('get-vendor-types') }}";
                $.ajax({url: url, success: function(result){
                    showVendorTypes(result);
                }});
            }

            getVendorTypes();

        });

    </script>
@endsection