@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">VENDOR INFORMATION</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">

        </div>
        <!-- /.row -->
    </div>

    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title" style="display: block">
                VENDOR CONTACT DETAILS
                <a href="#" class="btn pull-right flat btn-info btn-xs" data-toggle="modal" data-target="#addVendorContact">ADD NEW CONTACT</a>
            </h3>
        </div>
        <div class="box-body">
            <table id="vendorContactsTable" class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>

                <tbody id="vendorContactsDetails">
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="editVendorContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="vendor-contact-edit" action="#">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">EDIT CONTACT FOR THIS VENDOR</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control" required>
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
    <div class="modal fade" id="addVendorContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="vendor-contact-add" action="{{ route('vendor-contact',['id' => $vendor->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">ADD NEW CONTACT FOR THIS VENDOR</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="contact_person">Contact Person</label>
                            <input type="text" name="contact_person" id="contact_person" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control" required>
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
    @include('../partials.vendor-contact-list')
    <script>

        $(document).ready(function () {
            $(document).on('click', '.btn-edit-vendor-contact',function(e){
                var id = $(this).data('id');
                var url = "{{ route('vendor-contact') }}/" + id;
                var formUrl = "{{ route('update-vendor-contact') }}/" + id;
                $("#vendor-contact-edit").attr('action',formUrl);

                $.ajax({url: url, success: function(result){
                    $("#vendor-contact-edit input[name=contact_person]").val(result.contact_person);
                    $("#vendor-contact-edit input[name=contact_number]").val(result.contact_number);
                    $("#vendor-contact-edit input[name=address]").val(result.address);
                }});

            });
            $(document).on('click', '.btn-delete-vendor-contact',function(e){
                var id = $(this).data('id');
                var url = "{{ route('delete-vendor-contact') }}/" + id;

                $.ajax({url: url, success: function(result){
                    getVendorContacts();
                }});

            });

            $( "#vendor-contact-edit" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getVendorContacts();
                    $("#editVendorContact").modal('hide');
                });
                event.preventDefault();
            });
            $( "#vendor-contact-add" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getVendorContacts();
                    $("#addVendorContact").modal('hide');
                });
                event.preventDefault();
            });

            function showVendorContactDetails (data) {
                var theTemplateScript = $("#vendor-contact-lists").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#vendorContactsDetails').html(theCompiledHtml);

            };

            function getVendorContacts(){
                var url = "{{ route('vendor-contacts-json',['id' => $vendor->id]) }}";
                $.ajax({url: url, success: function(result){
                    showVendorContactDetails(result);
                }});
            }



            getVendorContacts();

        });

    </script>
@endsection