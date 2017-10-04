@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title" style="display: block">
                UNIT OF MEASUREMENT LIST
                <a href="#" class="btn pull-right flat btn-info btn-xs" data-toggle="modal" data-target="#addUnit">ADD NEW UNIT</a>
            </h3>
        </div>
        <div class="box-body">
            <table id="unitsTable" class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Unit</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>

                <tbody id="AllUnits">
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="editUnits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="units-edit" action="#">
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
    <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="unit-add" action="{{ route('unit') }}" method="post">
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
    @include('../partials.unit')
    <script>

        $(document).ready(function () {
            $(document).on('click', '.btn-edit-unit',function(e){
                var id = $(this).data('id');
                var url = "{{ route('unit') }}/" + id;
                var formUrl = "{{ route('update-unit') }}/" + id;
                $("#units-edit").attr('action',formUrl);

                $.ajax({url: url, success: function(result){
                    $("#units-edit input[name=name]").val(result.unit.name);
                }});

            });
            $(document).on('click', '.btn-delete-unit',function(e){
                var id = $(this).data('id');
                var url = "{{ route('delete-unit') }}/" + id;

                $.ajax({url: url, success: function(result){
                    getAllUnits();
                }});

            });

            $( "#units-edit" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getAllUnits();
                    $("#editUnits").modal('hide');
                    $( "#units-edit" )[0].reset();
                });
                event.preventDefault();
            });
            $( "#unit-add" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getAllUnits();
                    $("#addUnit").modal('hide');
                    $( "#unit-add" )[0].reset();
                });
                event.preventDefault();
            });

            function showAllUnits (data) {
                var theTemplateScript = $("#unit-list-data").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#AllUnits').html(theCompiledHtml);
                initializeDatatable();

            };

            function initializeDatatable() {
                $('#unitsTable').DataTable();
            }

            function getAllUnits(){
                var url = "{{ route('json-units') }}";
                $.ajax({url: url, success: function(result){
                    showAllUnits(result);
                }});
            }

            getAllUnits();

        });

    </script>
@endsection