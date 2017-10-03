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
                VENDOR DOCUMENT DETAILS
                <a href="#" class="btn pull-right flat btn-info btn-xs" data-toggle="modal" data-target="#addVendorDocument">ADD NEW CONTACT</a>
            </h3>
        </div>
        <div class="box-body">
            <table id="vendorDocumentsTable" class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Document Title</th>
                    <th>Document</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>

                <tbody id="vendorDocumentDetails">
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <div class="modal fade" id="addVendorDocument" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="vendor-document-add" action="{{ route('vendor-document',['id' => $vendor->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">ADD NEW DOCUMENT FOR THIS VENDOR</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Document Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <label for="document">Attach Document</label>
                            <input type="file" name="document" id="document" class="form-control" required>
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
    @include('../partials.vendor-document-list')
    <script>

        $(document).ready(function () {
            $(document).on('click', '.btn-delete-vendor-document',function(e){
                var id = $(this).data('id');
                var url = "{{ route('delete-vendor-document') }}/" + id;

                $.ajax({url: url, success: function(result){
                    getVendorContacts();
                }});

            });

            function showVendorDocumentDetails (data) {
                var theTemplateScript = $("#vendor-document-lists").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#vendorDocumentDetails').html(theCompiledHtml);

            };

            function getVendorContacts(){
                var url = "{{ route('vendor-documents-json',['id' => $vendor->id]) }}";
                $.ajax({url: url, success: function(result){
                    showVendorDocumentDetails(result);
                }});
            }



            getVendorContacts();

        });

    </script>
@endsection