@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form action="{{ route('post.vendor') }}" id="vendorForm" method="POST">
                {{ csrf_field() }}
            <table id="vendorFormTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>Vendor Name</label></th>
                    <th><label>Contact Person</label></th>
                    <th><label>Contact No</label></th>
                    <th><label>Address</label></th>
                    <th><label>Web Address</label></th>
                    <th><label>Trade No</label></th>
                    <th><label>Vat No</label></th>
                    <th><label>Company Name</label></th>
                    <th>
                        <button id="addFormRow" class="btn btn-success btn-add" type="button">
                            <i class="glyphicon glyphicon-plus gs"></i>
                        </button>
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input class="form-control vendor-name" name="vendor[0][name]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-address" name="vendor[0][address]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-contact-person" name="vendor[0][contact_person]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-contact-no" name="vendor[0][contact_no]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-web" name="vendor[0][web]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-trade-no" name="vendor[0][trade_no]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-vat-no" name="vendor[0][vat_no]" type="text" placeholder="Service Name" /></td>
                    <td><input class="form-control vendor-company" name="vendor[0][company]" type="text" placeholder="Service Name" /></td>
                    <td>
                        <button class="btn btn-danger btn-remove" type="button">
                            <i class="glyphicon glyphicon-minus gs"></i>
                        </button>
                    </td>
                </tr>
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="3">
                        <button class="btn btn-success btn-add" type="submit">
                            Save
                        </button>
                    </td>
                </tr>
                </tfoot>

            </table>
            </form>
            <form action="#" id="vendorEditForm" method="POST" style="display: none">
                {{ csrf_field() }}
            <table id="vendorEditFormTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>Vendor Name</label></th>
                    <th><label>Contact Person</label></th>
                    <th><label>Contact No</label></th>
                    <th><label>Address</label></th>
                    <th><label>Web Address</label></th>
                    <th><label>Trade No</label></th>
                    <th><label>Vat No</label></th>
                    <th><label>Company Name</label></th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input class="form-control vendor-name" name="name" type="text" placeholder="Vendor Name" /></td>
                    <td><input class="form-control vendor-address" name="address" type="text" placeholder="Vendor Address" /></td>
                    <td><input class="form-control vendor-contact-person" name="contact_person" type="text" placeholder="Vendor Contact Person" /></td>
                    <td><input class="form-control vendor-contact-no" name="contact_no" type="text" placeholder="Vendor Contact No" /></td>
                    <td><input class="form-control vendor-web" name="web" type="text" placeholder="Vendor Web" /></td>
                    <td><input class="form-control vendor-trade-no" name="trade_no" type="text" placeholder="Vendor Trade No" /></td>
                    <td><input class="form-control vendor-vat-no" name="vat_no" type="text" placeholder="Vendor Vat No" /></td>
                    <td><input class="form-control vendor-company" name="company" type="text" placeholder="Vendor Company" /></td>

                </tr>
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="3">
                        <button class="btn btn-danger btn-cancel-edit" type="button">
                            Cancel
                        </button>
                        <button class="btn btn-success btn-save-update" type="submit">
                            Update
                        </button>
                    </td>
                </tr>
                </tfoot>

            </table>
            </form>
        <!-- /.row -->
    </div>
    <div class="x_content">
        <div id="vendorsData"></div>
    </div>
    <div class="box-footer">

    </div>
    </div>
@endsection

@section('script')
    @include('../partials.vendors-list')
    <script>
        $(document).ready(function () {
            var rowCount = $('table#vendorFormTable >tbody:last >tr').length;
            if(rowCount == 1) {
                document.getElementsByClassName('btn-remove')[0].disabled = true;
            }
            var addRows = function () {
                var rowCount = $('table#vendorFormTable >tbody:last >tr').length;

                var controlForm = $('table#vendorFormTable>tbody');
                var currentEntry = '<tr>'+$('table#vendorFormTable>tbody>tr:last').html()+'</tr>';
                var newEntry = $(currentEntry).appendTo(controlForm);

                newEntry.find('input.vendor-name').attr('name','vendor['+rowCount+'][name]');
                newEntry.find('input.vendor-address').attr('name','vendor['+rowCount+'][address]');
                newEntry.find('input.vendor-contact-person').attr('name','vendor['+rowCount+'][contact_person]');
                newEntry.find('input.vendor-contact-no').attr('name','vendor['+rowCount+'][contact_no]');
                newEntry.find('input.vendor-web').attr('name','vendor['+rowCount+'][web]');
                newEntry.find('input.vendor-trade-no').attr('name','vendor['+rowCount+'][trade_no]');
                newEntry.find('input.vendor-vat-no').attr('name','vendor['+rowCount+'][vat_no]');
                newEntry.find('input.vendor-company').attr('name','vendor['+rowCount+'][company]');

                rowCount = $('table#vendorFormTable >tbody:last >tr').length;
                if(rowCount > 1) {
                    var removeButtons = document.getElementsByClassName('btn-remove');
                    for(var i = 0; i < removeButtons.length; i++) {
                        removeButtons.item(i).disabled = false;
                    }
                }
            };

            $("#addFormRow").click(function (e) {
                e.preventDefault();
                addRows();
            });

            $(document).on('click','.btn-remove',function (e) {
                $(this).parents('tr:first').remove();

                //Disable the Remove Button
                var rowCount = $('table#vendorFormTable >tbody:last >tr').length;
                if(rowCount == 1) {
                    document.getElementsByClassName('btn-remove')[0].disabled = true;
                }

                e.preventDefault();
            });

            $( "#vendorForm" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $( "#vendorForm" )[0].reset();
                    //$( "#serviceTypeForm" ).css({"display":"none"});

                    $('table#vendorFormTable > tbody > tr:not(:first)').remove();

                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getVendors();
                });
                event.preventDefault();
            });

            function vendorsData(data) {
                var theTemplateScript = $("#vendors-data-template").html();

                // Compile the template
                var theTemplate = Handlebars.compile(theTemplateScript);


                // Pass our data to the template
                var theCompiledHtml = theTemplate(data);
                // Add the compiled html to the page
                $('#vendorsData').html(theCompiledHtml);
            }

            var getVendors = function () {
                $.ajax({url: "{{ route('json-vendors') }}", success: function(result){
                    vendorsData(result);
                }});
            };

            $(document).on('click','.btn-delete',function (e) {
                console.log($(this));
                var url = "{{ route('json-delete-vendors') }}/"+$(this).data('id');

                $.ajax({
                    type        : 'GET',
                    url         : url,
                    encode      : true
                }).done(function(data) {
                    console.log(data);
                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getVendors();
                });
            });

            $(document).on('click','.btn-edit',function (e){
                var id = $(this).data('id');
                $.ajax({url: "{{ route('json-vendor') }}/"+id, success: function(result){
                    editFormValue(result.vendor);
                }});
            });

            function editFormValue(data) {
                var url = "{{ route('update-vendor') }}/"+data.id;
                $("#vendorEditForm").attr('action',url);
                $("#vendorEditForm").css({"display" : "block"});
                $("#vendorForm").css({"display" : "none"});

                $("#vendorEditForm input[name='name']").val(data.name);
                $("#vendorEditForm input[name='address']").val(data.address);
                $("#vendorEditForm input[name='contact_person']").val(data.contact_person);
                $("#vendorEditForm input[name='contact_no']").val(data.contact_no);
                $("#vendorEditForm input[name='web']").val(data.web);
                $("#vendorEditForm input[name='trade_no']").val(data.trade_no);
                $("#vendorEditForm input[name='vat_no']").val(data.vat_no);
                $("#vendorEditForm input[name='company']").val(data.company);
            }

            $("#vendorEditForm").on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {

                    $("#vendorEditForm").css({"display" : "none"});
                    $("#vendorEditForm")[0].reset();
                    $("#vendorForm").css({"display" : "block"});
                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getVendors();
                });
                event.preventDefault();
            });

            $(document).on('click','.btn-cancel-edit',function (e) {
                $("#vendorEditForm").css({"display" : "none"});
                $("#vendorEditForm")[0].reset();
                $("#vendorForm").css({"display" : "block"});
            });

            getVendors();
        });
    </script>
@endsection